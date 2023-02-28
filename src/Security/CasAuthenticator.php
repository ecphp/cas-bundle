<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Security;

use EcPhp\CasBundle\Security\Core\User\CasUserProviderInterface;
use EcPhp\CasLib\CasInterface;
use EcPhp\CasLib\Introspection\Contract\ServiceValidate;
use EcPhp\CasLib\Utils\Uri;
use InvalidArgumentException;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

final class CasAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface
{
    public function __construct(
        private CasInterface $cas,
        private HttpMessageFactoryInterface $httpMessageFactory,
        private CasUserProviderInterface $userProvider,
        private UrlGeneratorInterface $urlGenerator
    ) {
    }

    public function authenticate(Request $request): Passport
    {
        $response = $this
            ->cas
            ->withServerRequest($this->toPsr($request))
            ->requestTicketValidation();

        if (null === $response) {
            throw new AuthenticationException('Unable to authenticate the user with such service ticket.');
        }

        try {
            $introspect = $this->cas->detect($response);
        } catch (InvalidArgumentException $exception) {
            throw new AuthenticationException($exception->getMessage(), 0, $exception);
        }

        if (false === ($introspect instanceof ServiceValidate)) {
            throw new AuthenticationException(
                'Failure in the returned response'
            );
        }

        $user = $this->userProvider->loadUserByResponse($response);

        return new SelfValidatingPassport(
            new UserBadge(
                $user->getUserIdentifier(),
                static fn (): UserInterface => $user
            )
        );
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $uri = $this->toPsr($request)->getUri();

        if (false === Uri::hasParams($uri, 'ticket')) {
            return null;
        }

        // Remove the ticket parameter.
        $uri = Uri::removeParams(
            $uri,
            'ticket'
        );

        return new RedirectResponse((string) Uri::withParam($uri, 'renew', 'true'));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): Response
    {
        return new RedirectResponse(
            (string) Uri::removeParams(
                $this->toPsr($request)->getUri(),
                'ticket',
                'renew'
            )
        );
    }

    public function start(Request $request, ?AuthenticationException $authException = null): Response
    {
        if (true === $request->isXmlHttpRequest()) {
            return new JsonResponse(
                ['message' => 'Authentication required'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        return new RedirectResponse(
            $this
                ->urlGenerator
                ->generate(
                    'cas_bundle_login',
                )
        );
    }

    public function supports(Request $request): bool
    {
        return $this
            ->cas
            ->withServerRequest($this->toPsr($request))
            ->supportAuthentication();
    }

    /**
     * Convert a Symfony request into a PSR Request.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *   The Symfony request.
     *
     * @return \Psr\Http\Message\ServerRequestInterface
     *   The PSR request.
     */
    private function toPsr(Request $request): ServerRequestInterface
    {
        // As we cannot decorate the Symfony Request object, we convert it into
        // a PSR Request so we can override the PSR HTTP Message factory if
        // needed.
        // See the reasons at https://github.com/ecphp/cas-lib/issues/5
        return $this->httpMessageFactory->createRequest($request);
    }
}
