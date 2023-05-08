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
use EcPhp\CasLib\Contract\CasInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Throwable;

final class CasAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface
{
    public function __construct(
        private readonly CasInterface $cas,
        private readonly CasUserProviderInterface $userProvider,
        private readonly HttpFoundationFactoryInterface $httpFoundationFactory,
        private readonly HttpMessageFactoryInterface $httpMessageFactory
    ) {
    }

    public function authenticate(Request $request): Passport
    {
        try {
            $response = $this
                ->cas
                ->requestTicketValidation($this->toPsrRequest($request));
        } catch (Throwable $e) {
            throw new AuthenticationException(
                sprintf('Unable to authenticate the user with such service ticket, %s', $e->getMessage()),
                0,
                $e
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
        if (false === $request->query->has('ticket')) {
            return null;
        }

        $request->query->remove('ticket');
        $request->query->set('renew', 'true');

        // See: https://stackoverflow.com/questions/63037084/remove-parameters-from-symfony-4-4-httpfoundation-request-and-re-generate-url
        $request->overrideGlobals();

        return new RedirectResponse($request->getUri());
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): Response
    {
        $request->query->remove('ticket');
        $request->query->remove('renew');

        // See: https://stackoverflow.com/questions/63037084/remove-parameters-from-symfony-4-4-httpfoundation-request-and-re-generate-url
        $request->overrideGlobals();

        return new RedirectResponse($request->getUri());
    }

    public function start(Request $request, ?AuthenticationException $authException = null): Response
    {
        if (true === $request->isXmlHttpRequest()) {
            return new JsonResponse(
                ['message' => 'Authentication required'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        // Here we could also forward the request to `cas_bundle_login`.
        // Maybe this is something we should do at some point.
        try {
            $response = $this->cas->login($this->toPsrRequest($request));
        } catch (Throwable $e) {
            throw new AuthenticationException(
                sprintf('Unable to start CAS authentication login procedure. (Reason: %s)', $e->getMessage()),
                0,
                $e
            );
        }

        return $this->httpFoundationFactory->createResponse($response);
    }

    public function supports(Request $request): bool
    {
        return $this
            ->cas
            ->supportAuthentication($this->toPsrRequest($request));
    }

    private function toPsrRequest(Request $request): ServerRequestInterface
    {
        return $this->httpMessageFactory->createRequest($request);
    }
}
