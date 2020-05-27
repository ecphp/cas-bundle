<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Security;

use EcPhp\CasBundle\Security\Core\User\CasUser;
use EcPhp\CasLib\CasInterface;
use EcPhp\CasLib\Introspection\Contract\ServiceValidate;
use EcPhp\CasLib\Introspection\Introspector;
use EcPhp\CasLib\Utils\Uri;
use InvalidArgumentException;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

/**
 * Class CasAuthenticator.
 */
class CasAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface
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
     * CasAuthenticator constructor.
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

    public function authenticate(Request $request): PassportInterface
    {
        $response = $this
            ->cas
            ->requestTicketValidation();

        if (null === $response) {
            throw new AuthenticationException('Unable to authenticate the user with such service ticket.');
        }

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

        return new SelfValidatingPassport(new CasUser($introspect->getCredentials()));
    }

    public function onAuthenticationFailure(
        Request $request,
        AuthenticationException $exception
    ): ?Response {
        return null;
    }

    public function onAuthenticationSuccess(
        Request $request,
        TokenInterface $token,
        string $firewallName
    ): ?Response {
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

    public function start(
        Request $request,
        ?AuthenticationException $authException = null
    ) {
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
            throw new AuthenticationException('Unable to start the authentication process.', 0, $authException);
        }

        return new RedirectResponse(
            $response
                ->getHeaderLine('location')
        );
    }

    public function supports(Request $request): ?bool
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
}
