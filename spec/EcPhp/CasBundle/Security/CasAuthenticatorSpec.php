<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace spec\EcPhp\CasBundle\Security;

use EcPhp\CasBundle\Cas\SymfonyCas;
use EcPhp\CasBundle\Cas\SymfonyCasInterface;
use EcPhp\CasBundle\Security\CasAuthenticator;
use EcPhp\CasBundle\Security\Core\User\CasUserProvider;
use EcPhp\CasLib\Cas;
use EcPhp\CasLib\Response\CasResponseBuilder;
use EcPhp\CasLib\Response\Factory\AuthenticationFailureFactory;
use EcPhp\CasLib\Response\Factory\ProxyFactory;
use EcPhp\CasLib\Response\Factory\ProxyFailureFactory;
use EcPhp\CasLib\Response\Factory\ServiceValidateFactory;
use loophp\psr17\Psr17;
use loophp\UnalteredPsrHttpMessageBridgeBundle\Factory\UnalteredPsrHttpFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Nyholm\Psr7\ServerRequest;
use PhpSpec\ObjectBehavior;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
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
        $cas = $this->getCas();

        $psr17Factory = new Psr17Factory();

        $psrHttpMessageFactory = new PsrHttpFactory(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        $casResponseBuilder = new CasResponseBuilder(
            new AuthenticationFailureFactory(),
            new ProxyFactory(),
            new ProxyFailureFactory(),
            new ServiceValidateFactory()
        );

        $casUserProvider = new CasUserProvider($casResponseBuilder, $psrHttpMessageFactory);

        $this
            ->beConstructedWith($cas, $casUserProvider);

        $this
            ->supports(Request::create('http://app'))
            ->shouldReturn(false);

        $this
            ->supports(Request::create('http://app/?ticket=ticket'))
            ->shouldReturn(true);
    }

    public function it_can_check_if_authentication_is_supported_when_url_contains_a_ticket(
        SymfonyCasInterface $cas,
    ) {
        $requestOk = Request::create('http://app/?ticket=ticket');

        $cas
            ->supportAuthentication($requestOk)
            ->willReturn(true);

        $psr17Factory = new Psr17Factory();

        $psrHttpMessageFactory = new PsrHttpFactory(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        $casResponseBuilder = new CasResponseBuilder(
            new AuthenticationFailureFactory(),
            new ProxyFactory(),
            new ProxyFailureFactory(),
            new ServiceValidateFactory()
        );

        $casUserProvider = new CasUserProvider($casResponseBuilder, $psrHttpMessageFactory);

        $this->beConstructedWith($cas, $casUserProvider);

        $this
            ->supports($requestOk)
            ->shouldReturn(true);
    }

    public function it_can_check_if_authentication_is_supported_when_url_does_not_contains_a_ticket(
        SymfonyCasInterface $cas,
    ) {
        $requestNotOk = Request::create('http://app');
        $cas
            ->supportAuthentication($requestNotOk)
            ->willReturn(false);

        $psr17Factory = new Psr17Factory();

        $psrHttpMessageFactory = new PsrHttpFactory(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        $casResponseBuilder = new CasResponseBuilder(
            new AuthenticationFailureFactory(),
            new ProxyFactory(),
            new ProxyFailureFactory(),
            new ServiceValidateFactory()
        );

        $casUserProvider = new CasUserProvider($casResponseBuilder, $psrHttpMessageFactory);

        $this->beConstructedWith($cas, $casUserProvider);

        $this
            ->supports($requestNotOk)
            ->shouldReturn(false);
    }

    public function it_can_check_the_credentials_when_service_and_ticket_parameters_are_available(
        SymfonyCasInterface $cas,
    ) {
        $responseBody = [
            'serviceResponse' => [
                'authenticationSuccess' => [
                    'user' => 'user',
                ],
            ],
        ];

        $request = Request::create('https://foo?service=service&ticket=ticket');
        $response = new Response(200, ['Content-Type' => 'application/json'], json_encode($responseBody));

        $cas
            ->authenticate($request)
            ->willReturn($responseBody);

        $cas
            ->requestTicketValidation($request)
            ->willReturn($response);

        $psr17Factory = new Psr17Factory();

        $psrHttpMessageFactory = new PsrHttpFactory(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        $casResponseBuilder = new CasResponseBuilder(
            new AuthenticationFailureFactory(),
            new ProxyFactory(),
            new ProxyFailureFactory(),
            new ServiceValidateFactory()
        );

        $casUserProvider = new CasUserProvider($casResponseBuilder, $psrHttpMessageFactory);

        $this->beConstructedWith($cas, $casUserProvider);

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
        SymfonyCasInterface $cas
    ) {
        $responseBody = [
            'serviceResponse' => [
                'authenticationSuccess' => [
                    'user' => 'user',
                ],
            ],
        ];

        $request = Request::create('https://foo?service=service&ticket=ticket');
        $response = new Response(200, ['Content-Type' => 'application/json'], json_encode($responseBody));

        $cas
            ->authenticate($request)
            ->willReturn($responseBody);

        $cas
            ->requestTicketValidation($request)
            ->willReturn($response);

        $psr17Factory = new Psr17Factory();

        $psrHttpMessageFactory = new PsrHttpFactory(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        $casResponseBuilder = new CasResponseBuilder(
            new AuthenticationFailureFactory(),
            new ProxyFactory(),
            new ProxyFailureFactory(),
            new ServiceValidateFactory()
        );

        $casUserProvider = new CasUserProvider($casResponseBuilder, $psrHttpMessageFactory);

        $this->beConstructedWith($cas, $casUserProvider);

        $passport = $this
            ->authenticate($request);
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
        SymfonyCasInterface $cas,
    ) {
        $request = Request::create('https://foo?service=service');

        $cas
            ->authenticate($request)
            ->willThrow(AuthenticationException::class);

        $cas
            ->requestTicketValidation($request)
            ->willThrow(AuthenticationException::class);

        $psr17Factory = new Psr17Factory();

        $psrHttpMessageFactory = new PsrHttpFactory(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        $casResponseBuilder = new CasResponseBuilder(
            new AuthenticationFailureFactory(),
            new ProxyFactory(),
            new ProxyFailureFactory(),
            new ServiceValidateFactory()
        );

        $casUserProvider = new CasUserProvider($casResponseBuilder, $psrHttpMessageFactory);

        $this->beConstructedWith($cas, $casUserProvider);

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

        $psrHttpMessageFactory = new PsrHttpFactory(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        $casResponseBuilder = new CasResponseBuilder(
            new AuthenticationFailureFactory(),
            new ProxyFactory(),
            new ProxyFailureFactory(),
            new ServiceValidateFactory()
        );

        $unalteredPsrHttpMessageFactory = new UnalteredPsrHttpFactory($psrHttpMessageFactory, $psr17Factory);

        $casUserProvider = new CasUserProvider($casResponseBuilder, $psrHttpMessageFactory);

        $this
            ->beConstructedWith($cas, $casUserProvider);
    }

    private function getCas(): SymfonyCasInterface
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

        $psrHttpMessageFactory = new PsrHttpFactory(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        return new SymfonyCas(
            new Cas(
                $properties,
                $client,
                $psr17,
                $cache,
                $casResponseBuilder
            ),
            $psrHttpMessageFactory
        );
    }
}
