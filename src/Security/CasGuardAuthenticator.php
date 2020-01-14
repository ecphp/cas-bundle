<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Security;

use EcPhp\CasBundle\Security\Core\User\CasUserProviderInterface;
use EcPhp\CasLib\CasInterface;
use EcPhp\CasLib\Introspection\Contract\ServiceValidate;
use EcPhp\CasLib\Introspection\Introspector;
use EcPhp\CasLib\Utils\Uri;
use InvalidArgumentException;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @var \EcPhp\CasLib\CasInterface
     */
    private $cas;

    /**
     * @var \Psr\Http\Message\ServerRequestFactoryInterface
     */
    private $serverRequestFactory;

    /**
     * @var \Psr\Http\Message\UriFactoryInterface
     */
    private $uriFactory;

    /**
     * CasGuardAuthenticator constructor.
     *
     * @param \EcPhp\CasLib\CasInterface $cas
     * @param \Psr\Http\Message\UriFactoryInterface $uriFactory
     * @param \Psr\Http\Message\ServerRequestFactoryInterface $serverRequestFactory
     */
    public function __construct(
        CasInterface $cas,
        UriFactoryInterface $uriFactory,
        ServerRequestFactoryInterface $serverRequestFactory
    ) {
        $this->cas = $cas;
        $this->uriFactory = $uriFactory;
        $this->serverRequestFactory = $serverRequestFactory;
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
