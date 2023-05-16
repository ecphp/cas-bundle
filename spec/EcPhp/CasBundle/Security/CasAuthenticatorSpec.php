<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace spec\EcPhp\CasBundle\Security;

use EcPhp\CasBundle\Security\CasAuthenticator;
use EcPhp\CasBundle\Security\Core\User\CasUser;
use EcPhp\CasBundle\Security\Core\User\CasUserProvider;
use EcPhp\CasBundle\Security\Core\User\CasUserProviderInterface;
use EcPhp\CasLib\Cas;
use EcPhp\CasLib\Contract\CasInterface;
use EcPhp\CasLib\Response\CasResponseBuilder;
use EcPhp\CasLib\Response\Factory\AuthenticationFailureFactory;
use EcPhp\CasLib\Response\Factory\ProxyFactory;
use EcPhp\CasLib\Response\Factory\ProxyFailureFactory;
use EcPhp\CasLib\Response\Factory\ServiceValidateFactory;
use loophp\psr17\Psr17;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\ServerRequest;
use PhpSpec\ObjectBehavior;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\HttpClient\Psr18Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class CasAuthenticatorSpec extends ObjectBehavior
{
    public function it_can_check_if_authentication_is_supported_when_a_user_is_logged_in()
    {
        $this
            ->supports(Request::create('http://app'))
            ->shouldReturn(false);

        $this
            ->supports(Request::create('http://app/?ticket=ticket'))
            ->shouldReturn(true);
    }

    public function it_can_check_if_authentication_is_supported_when_url_contains_a_ticket(
        CasInterface $cas,
        CasUserProviderInterface $casUserProvider,
        HttpMessageFactoryInterface $httpMessageFactory,
        HttpFoundationFactoryInterface $httpFoundationFactory
    ) {
        $request = Request::create('http://app/?ticket=ticket');
        $psrRequest = $this->getHttpMessageFactory()->createRequest($request);

        $httpMessageFactory
            ->createRequest($request)
            ->willReturn($psrRequest);

        $cas
            ->supportAuthentication($psrRequest)
            ->willReturn(true);

        $this->beConstructedWith(
            $cas,
            $casUserProvider,
            $httpFoundationFactory,
            $httpMessageFactory
        );

        $this
            ->supports($request)
            ->shouldReturn(true);
    }

    public function it_can_check_if_authentication_is_supported_when_url_does_not_contains_a_ticket(
        CasInterface $cas,
        CasUserProviderInterface $casUserProvider,
        HttpMessageFactoryInterface $httpMessageFactory,
        HttpFoundationFactoryInterface $httpFoundationFactory
    ) {
        $request = Request::create('http://app');
        $psrRequest = $this->getHttpMessageFactory()->createRequest($request);

        $httpMessageFactory
            ->createRequest($request)
            ->willReturn($psrRequest);

        $cas
            ->supportAuthentication($psrRequest)
            ->willReturn(false);

        $this->beConstructedWith(
            $cas,
            $casUserProvider,
            $httpFoundationFactory,
            $httpMessageFactory
        );

        $this
            ->supports($request)
            ->shouldReturn(false);
    }

    public function it_can_check_the_credentials_when_service_and_ticket_parameters_are_available(
        CasInterface $cas,
        CasUserProviderInterface $casUserProvider,
        HttpMessageFactoryInterface $httpMessageFactory,
        HttpFoundationFactoryInterface $httpFoundationFactory
    ) {
        $responseBody = [
            'serviceResponse' => [
                'authenticationSuccess' => [
                    'user' => 'user',
                ],
            ],
        ];

        $request = Request::create('https://foo?service=service&ticket=ticket');
        $response = new JsonResponse($responseBody);
        $psrResponse = $this->getHttpMessageFactory()->createResponse($response);
        $psrRequest = $this->getHttpMessageFactory()->createRequest($request);

        $httpMessageFactory
            ->createRequest($request)
            ->willReturn($psrRequest);

        $httpMessageFactory
            ->createResponse($response)
            ->willReturn($psrResponse);

        $httpFoundationFactory
            ->createResponse($psrResponse)
            ->willReturn($response);

        $casUserProvider
            ->loadUserByResponse($response)
            ->willReturn(new CasUser(['user' => 'user']));

        $cas
            ->requestTicketValidation($psrRequest)
            ->willReturn($psrResponse);

        $cas
            ->authenticate($psrRequest)
            ->willReturn($responseBody);

        $this->beConstructedWith(
            $cas,
            $casUserProvider,
            $httpFoundationFactory,
            $httpMessageFactory
        );

        $this
            ->authenticate($request)
            ->shouldBeAnInstanceOf(Passport::class);

        // ticket parameter is missing
        // $request = Request::create('https://foo?service=service');

        // $this
        //     ->shouldThrow(AuthenticationException::class)
        //     ->during('authenticate', [$request]);

        // $request = Request::create('https://invalidXml?service=invalid-xml&ticket=ticket');

        // $this
        //     ->shouldThrow(AuthenticationException::class)
        //     ->during('authenticate', [$request]);
    }

    // TODO: Where to implement this?
    // public function it_can_detect_when_the_request_is_an_ajax_request_and_respond_accordingly()
    // {
    //     $request = new ServerRequest(
    //         'GET',
    //         'http://app/?ticket=ticket',
    //         ['X-Requested-With' => 'XMLHttpRequest']
    //     );

    //     $this
    //         ->start((new HttpFoundationFactory())->createRequest($request))
    //         ->shouldBeAnInstanceOf(JsonResponse::class);
    // }

    public function it_can_get_the_user_from_the_response(
        CasInterface $cas,
        CasUserProviderInterface $casUserProvider,
        HttpMessageFactoryInterface $httpMessageFactory,
        HttpFoundationFactoryInterface $httpFoundationFactory
    ) {
        $responseBody = [
            'serviceResponse' => [
                'authenticationSuccess' => [
                    'user' => 'user',
                ],
            ],
        ];

        $request = Request::create('https://foo?service=service&ticket=ticket');
        $response = new JsonResponse($responseBody);
        $psrResponse = $this->getHttpMessageFactory()->createResponse($response);
        $psrRequest = $this->getHttpMessageFactory()->createRequest($request);

        $httpMessageFactory
            ->createRequest($request)
            ->willReturn($psrRequest);

        $httpMessageFactory
            ->createResponse($response)
            ->willReturn($psrResponse);

        $httpFoundationFactory
            ->createResponse($psrResponse)
            ->willReturn($response);

        $cas
            ->requestTicketValidation($psrRequest)
            ->willReturn($psrResponse);

        $cas
            ->authenticate($request)
            ->willReturn($responseBody);

        $casUserProvider
            ->loadUserByResponse($response)
            ->willReturn(new CasUser(['user' => 'user']));

        $this->beConstructedWith(
            $cas,
            $casUserProvider,
            $httpFoundationFactory,
            $httpMessageFactory
        );

        $passport = $this->authenticate($request);

        $passport
            ->shouldBeAnInstanceOf(Passport::class);
        $passport
            ->getUser('user');
    }

    public function it_can_redirect_on_failed_authentication_when_ticket_parameter_is_available(
        AuthenticationException $authenticationException
    ) {
        $request = Request::create('http://protected-resource/?ticket=ticket');

        $this
            ->onAuthenticationFailure($request, $authenticationException)
            ->shouldBeAnInstanceOf(RedirectResponse::class);

        $request = Request::create('http://protected-resource/?ticket=ticket');

        $this
            ->onAuthenticationFailure($request, $authenticationException)
            ->getTargetUrl()
            ->shouldReturn('http://protected-resource/?renew=true');
    }

    public function it_can_redirect_on_failed_authentication_when_ticket_parameter_is_not_available(
        AuthenticationException $authenticationException
    ) {
        $request = Request::create('http://protected-resource/');

        $this
            ->onAuthenticationFailure($request, $authenticationException)
            ->shouldBeNull();
    }

    public function it_can_redirect_on_success_authentication(TokenInterface $token)
    {
        $request = Request::create('http://app/?param.key=value&ticket=ticket&renew=true');

        $response = $this
            ->onAuthenticationSuccess($request, $token, 'cas');

        $response
            ->shouldBeAnInstanceOf(RedirectResponse::class);

        $response
            ->getTargetUrl()
            ->shouldReturn('http://app/?param_key=value');

        $response
            ->headers
            ->all()
            ->shouldNotHaveKey('renew');
    }

    public function it_cannot_check_the_credentials_when_ticket_is_missing(
        CasInterface $cas,
        CasUserProviderInterface $casUserProvider,
        HttpMessageFactoryInterface $httpMessageFactory,
        HttpFoundationFactoryInterface $httpFoundationFactory
    ) {
        $request = Request::create('https://foo?service=service');
        $response = new JsonResponse();
        $psrResponse = $this->getHttpMessageFactory()->createResponse($response);
        $psrRequest = $this->getHttpMessageFactory()->createRequest($request);

        $httpMessageFactory
            ->createRequest($request)
            ->willReturn($psrRequest);

        $httpMessageFactory
            ->createResponse($response)
            ->willReturn($psrResponse);

        $httpFoundationFactory
            ->createResponse($psrResponse)
            ->willReturn($response);

        $cas
            ->authenticate($psrRequest)
            ->willThrow(AuthenticationException::class);

        $cas
            ->requestTicketValidation($psrRequest)
            ->willThrow(AuthenticationException::class);

        $this->beConstructedWith(
            $cas,
            $casUserProvider,
            $httpFoundationFactory,
            $httpMessageFactory
        );

        $this
            ->shouldThrow(AuthenticationException::class)
            ->during('authenticate', [$request]);
    }

    // TODO: Does not exist anymore?
    // public function it_can_redirect_to_the_login_url()
    // {
    //     $request = Request::create('http://app/?ticket=ticket');

    //     $this
    //         ->start($request)
    //         ->shouldBeAnInstanceOf(RedirectResponse::class);

    //     $this
    //         ->start($request)
    //         ->headers
    //         ->all()
    //         ->shouldHaveKeyWithValue('location', ['http://local/cas/login?service=http%3A%2F%2Fapp']);
    // }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CasAuthenticator::class);
    }

    public function let()
    {
        $cas = $this->getCas();

        $psr17Factory = new Psr17Factory();

        $httpMessageFactory = new PsrHttpFactory(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        $httpFoundationMessageFactory = new HttpFoundationFactory();

        $casResponseBuilder = new CasResponseBuilder(
            new AuthenticationFailureFactory(),
            new ProxyFactory(),
            new ProxyFailureFactory(),
            new ServiceValidateFactory()
        );

        $casUserProvider = new CasUserProvider($casResponseBuilder, $httpMessageFactory);

        $this->beConstructedWith(
            $cas,
            $casUserProvider,
            $httpFoundationMessageFactory,
            $httpMessageFactory
        );
    }

    private function getCas(): CasInterface
    {
        $properties = \spec\EcPhp\CasBundle\Cas::getTestProperties();
        $client = new Psr18Client(\spec\EcPhp\CasBundle\Cas::getHttpClientMock());
        $cache = new ArrayAdapter();

        $psr17Factory = new Psr17Factory();
        $psr17 = new Psr17($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $casResponseBuilder = new CasResponseBuilder(
            new AuthenticationFailureFactory(),
            new ProxyFactory(),
            new ProxyFailureFactory(),
            new ServiceValidateFactory()
        );

        return
            new Cas(
                $properties,
                $client,
                $psr17,
                $cache,
                $casResponseBuilder
            );
    }

    private function getHttpMessageFactory(): HttpMessageFactoryInterface
    {
        $psr17Factory = new Psr17Factory();

        return new PsrHttpFactory(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );
    }
}
