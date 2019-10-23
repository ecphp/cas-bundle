<?php

declare(strict_types=1);

namespace drupol\CasBundle\Security;

use drupol\CasBundle\Security\Core\User\CasUserProviderInterface;
use drupol\psrcas\CasInterface;
use drupol\psrcas\Introspection\Contract\ServiceValidate;
use drupol\psrcas\Introspection\Introspector;
use drupol\psrcas\Utils\Uri;
use InvalidArgumentException;
use Psr\Http\Message\UriFactoryInterface;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @var \Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface
     */
    private $httpFoundationFactory;

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
     * @param \Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface $httpFoundationFactory
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage
     */
    public function __construct(
        CasInterface $cas,
        UriFactoryInterface $uriFactory,
        HttpFoundationFactoryInterface $httpFoundationFactory,
        TokenStorageInterface $tokenStorage
    ) {
        $this->cas = $cas;
        $this->uriFactory = $uriFactory;
        $this->httpFoundationFactory = $httpFoundationFactory;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function checkCredentials($response, UserInterface $user)
    {
        try {
            $introspect = Introspector::detect($response);
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
    public function getUser($response, UserProviderInterface $userProvider)
    {
        if (false === ($userProvider instanceof CasUserProviderInterface)) {
            throw new AuthenticationException('Unable to load the user through the given User Provider.');
        }

        if (null === $user = $userProvider->loadUserByResponse($response)) {
            throw new AuthenticationException('Unable to authenticate the user with such credentials.');
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if ($request->query->has('ticket')) {
            return new RedirectResponse(
                (string) Uri::removeParams(
                    $this->uriFactory->createUri(
                        $request->getUri()
                    ),
                    'ticket'
                )
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse(
            (string) Uri::removeParams(
                $this->uriFactory->createUri(
                    $request->getUri()
                ),
                'ticket'
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function onLogoutSuccess(Request $request)
    {
        return $this
            ->httpFoundationFactory
            ->createResponse(
                $this
                    ->cas
                    ->logout()
            );
    }

    /**
     * {@inheritdoc}
     */
    public function start(Request $request, ?AuthenticationException $authException = null)
    {
        return $this
            ->httpFoundationFactory
            ->createResponse(
                $this
                    ->cas
                    ->login()
            );
    }

    /**
     * {@inheritdoc}
     */
    public function supports(Request $request)
    {
        if (null !== $this->tokenStorage->getToken()) {
            return false;
        }

        return $this
            ->cas
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
