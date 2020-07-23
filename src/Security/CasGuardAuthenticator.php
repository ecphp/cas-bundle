<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Security;

use EcPhp\CasBundle\Security\Core\User\CasUserProviderInterface;
use EcPhp\CasLib\CasInterface;
use EcPhp\CasLib\Introspection\Contract\ServiceValidate;
use EcPhp\CasLib\Utils\Uri;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class CasGuardAuthenticator extends AbstractGuardAuthenticator implements LogoutSuccessHandlerInterface
{
    /**
     * The ecphp/cas-lib library.
     *
     * @var \EcPhp\CasLib\CasInterface
     */
    private $cas;

    /**
     * @var \Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface
     */
    private $httpMessageFactory;

    public function __construct(
        CasInterface $cas,
        HttpMessageFactoryInterface $httpMessageFactory
    ) {
        $this->cas = $cas;
        $this->httpMessageFactory = $httpMessageFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function checkCredentials($credentials, UserInterface $user): bool
    {
        try {
            $introspect = $this->cas->detect($credentials);
        } catch (InvalidArgumentException $exception) {
            throw new AuthenticationException($exception->getMessage());
        }

        if (false === ($introspect instanceof ServiceValidate)) {
            throw new AuthenticationException(
                'Failure in the returned response'
            );
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getCredentials(Request $request): ?ResponseInterface
    {
        $response = $this
            ->cas->withServerRequest($this->toPsr($request))
            ->requestTicketValidation();

        if (null === $response) {
            throw new AuthenticationException('Unable to authenticate the user with such service ticket.');
        }

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {
        if (false === ($userProvider instanceof CasUserProviderInterface)) {
            throw new AuthenticationException('Unable to load the user through the given User Provider.');
        }

        try {
            $user = $userProvider->loadUserByResponse($credentials);
        } catch (AuthenticationException $exception) {
            throw $exception;
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $uri = $this->toPsr($request)->getUri();

        if (true === Uri::hasParams($uri, 'ticket')) {
            // Remove the ticket parameter.
            $uri = Uri::removeParams(
                $uri,
                'ticket'
            );

            // Add the renew parameter to force login again.
            $uri = Uri::withParam($uri, 'renew', 'true');

            return new RedirectResponse((string) $uri);
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey): Response
    {
        return new RedirectResponse(
            (string) Uri::removeParams(
                $this->toPsr($request)->getUri(),
                'ticket',
                'renew'
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function onLogoutSuccess(Request $request): Response
    {
        $response = $this
            ->cas
            ->logout();

        if (null === $response) {
            throw new AuthenticationException('Unable to trigger the logout procedure');
        }

        return new RedirectResponse(
            $response
                ->getHeaderLine('location')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function start(Request $request, ?AuthenticationException $authException = null): Response
    {
        if (true === $request->isXmlHttpRequest()) {
            return new JsonResponse(
                ['message' => 'Authentication required'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $response = $this
            ->cas
            ->login();

        if (null === $response) {
            throw new AuthenticationException('Unable to trigger the login procedure');
        }

        return new RedirectResponse(
            $response
                ->getHeaderLine('location')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supports(Request $request): bool
    {
        return $this
            ->cas
            ->withServerRequest($this->toPsr($request))
            ->supportAuthentication();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsRememberMe(): bool
    {
        return false;
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
