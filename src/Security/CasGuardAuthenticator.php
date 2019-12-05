<?php

declare(strict_types=1);

namespace drupol\CasBundle\Security;

use drupol\CasBundle\Security\Core\User\CasUserProviderInterface;
use drupol\psrcas\CasInterface;
use drupol\psrcas\Introspection\Contract\ServiceValidate;
use drupol\psrcas\Introspection\Introspector;
use drupol\psrcas\Utils\Uri;
use InvalidArgumentException;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

/**
 * Class CasGuardAuthenticator.
 */
class CasGuardAuthenticator extends AbstractGuardAuthenticator implements LogoutSuccessHandlerInterface
{
    /**
     * The PSR CAS library.
     *
     * @var \drupol\psrcas\CasInterface
     */
    private $cas;

    /**
     * @var \Psr\Http\Message\ServerRequestFactoryInterface
     */
    private $serverRequestFactory;

    /**
     * @var \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var \Psr\Http\Message\UriFactoryInterface
     */
    private $uriFactory;

    /**
     * CasGuardAuthenticator constructor.
     *
     * @param \drupol\psrcas\CasInterface $cas
     * @param \Psr\Http\Message\UriFactoryInterface $uriFactory
     * @param \Psr\Http\Message\ServerRequestFactoryInterface $serverRequestFactory
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage
     */
    public function __construct(
        CasInterface $cas,
        UriFactoryInterface $uriFactory,
        ServerRequestFactoryInterface $serverRequestFactory,
        TokenStorageInterface $tokenStorage
    ) {
        $this->cas = $cas;
        $this->uriFactory = $uriFactory;
        $this->serverRequestFactory = $serverRequestFactory;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        try {
            $introspect = Introspector::detect($credentials);
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
    public function getCredentials(Request $request)
    {
        $response = $this
            ->cas
            ->requestTicketValidation();

        if (null === $response) {
            throw new AuthenticationException('Unable to authenticate the user with such service ticket.');
        }

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
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
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if (true === $request->query->has('ticket')) {
            // Remove the ticket parameter.
            $uri = Uri::removeParams(
                $this->uriFactory->createUri(
                    $request->getUri()
                ),
                'ticket'
            );

            // Add the renew parameter to force login again.
            $uri = Uri::withParam($uri, 'renew', 'true');

            return new RedirectResponse((string) $uri);
        }
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     *
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse(
            (string) Uri::removeParams(
                $this->uriFactory->createUri(
                    $request->getUri()
                ),
                'ticket',
                'renew'
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function onLogoutSuccess(Request $request)
    {
        return new RedirectResponse(
            $this
                ->cas
                ->logout()
                ->getHeaderLine('location')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function start(Request $request, ?AuthenticationException $authException = null)
    {
        return new RedirectResponse(
            $this
                ->cas
                ->login()
                ->getHeaderLine('location')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supports(Request $request)
    {
        return $this
            ->cas
            ->withServerRequest(
                $this
                    ->serverRequestFactory
                    ->createServerRequest(
                        $request->getMethod(),
                        $request->getUri()
                    )
            )
            ->supportAuthentication();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsRememberMe()
    {
        return false;
    }
}
