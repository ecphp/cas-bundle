<?php

declare(strict_types=1);

namespace spec\drupol\CasBundle\Security;

use drupol\CasBundle\Security\CasGuardAuthenticator;
use drupol\CasBundle\Security\Core\User\CasUserInterface;
use drupol\CasBundle\Security\Core\User\CasUserProvider;
use drupol\psrcas\Cas;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Nyholm\Psr7\ServerRequest;
use PhpSpec\ObjectBehavior;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\HttpClient\Psr18Client;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;

class CasGuardAuthenticatorSpec extends ObjectBehavior
{
    public function it_can_check_if_authentication_is_supported()
    {
        $this
            ->supports(Request::create('http://app/?ticket=ticket'))
            ->shouldReturn(true);

        $this
            ->supports(Request::create('http://app'))
            ->shouldReturn(false);
    }

    public function it_can_check_if_rememberMe_is_enabled()
    {
        $this
            ->supportsRememberMe()
            ->shouldReturn(false);
    }

    public function it_can_check_the_credentials(UserInterface $user)
    {
        $body = <<< 'EOF'
<cas:serviceResponse xmlns:cas="http://www.yale.edu/tp/cas">
 <cas:authenticationSuccess>
  <cas:user>username</cas:user>
 </cas:authenticationSuccess>
</cas:serviceResponse>
EOF;

        $response = new Response(200, ['content-type' => 'application/xml'], $body);

        $this
            ->checkCredentials($response, $user)
            ->shouldReturn(true);

        $body = <<< 'EOF'
<cas:serviceResponse xmlns:cas="http://www.yale.edu/tp/cas">
 <cas:authenticationFailure>
 </cas:authenticationFailure>
</cas:serviceResponse>
EOF;

        $response = new Response(200, ['content-type' => 'application/xml'], $body);

        $this
            ->shouldThrow(AuthenticationException::class)
            ->during('checkCredentials', [$response, $user]);
    }

    public function it_can_get_the_user_from_the_response()
    {
        $body = <<< 'EOF'
<cas:serviceResponse xmlns:cas="http://www.yale.edu/tp/cas">
 <cas:authenticationSuccess>
  <cas:user>username</cas:user>
 </cas:authenticationSuccess>
</cas:serviceResponse>
EOF;

        $response = new Response(200, ['content-type' => 'application/xml'], $body);
        $casUserProvider = new CasUserProvider();

        $this
            ->getUser($response, $casUserProvider)
            ->shouldBeAnInstanceOf(CasUserInterface::class);
    }

    public function it_can_redirect_on_failed_authentication(TokenInterface $token, AuthenticationException $authenticationException)
    {
        $request = Request::create('http://app/?ticket=ticket');

        $this
            ->onAuthenticationFailure($request, $authenticationException)
            ->shouldBeAnInstanceOf(RedirectResponse::class);

        $this
            ->onAuthenticationFailure($request, $authenticationException)
            ->headers
            ->all()
            ->shouldHaveKeyWithValue('location', ['http://app/']);
    }

    public function it_can_redirect_on_success_authentication(TokenInterface $token)
    {
        $request = Request::create('http://app/?ticket=ticket');

        $this
            ->onAuthenticationSuccess($request, $token, 'cas')
            ->shouldBeAnInstanceOf(RedirectResponse::class);

        $this
            ->onAuthenticationSuccess($request, $token, 'cas')
            ->headers
            ->all()
            ->shouldHaveKeyWithValue('location', ['http://app/']);
    }

    public function it_can_redirect_on_success_logout()
    {
        $request = Request::create('http://app/?ticket=ticket');

        $this
            ->onLogoutSuccess($request)
            ->shouldBeAnInstanceOf(\Symfony\Component\HttpFoundation\Response::class);

        $this
            ->onLogoutSuccess($request)
            ->headers
            ->all()
            ->shouldHaveKeyWithValue('location', ['http://local/cas/logout']);
    }

    public function it_can_redirect_to_the_login_url()
    {
        $request = Request::create('http://app/?ticket=ticket');

        $this
            ->start($request)
            ->shouldBeAnInstanceOf(\Symfony\Component\HttpFoundation\Response::class);

        $this
            ->start($request)
            ->headers
            ->all()
            ->shouldHaveKeyWithValue('location', ['http://local/cas/login']);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CasGuardAuthenticator::class);
    }

    public function let(TokenStorageInterface $tokenStorage)
    {
        $serverRequest = new ServerRequest('GET', 'http://app');
        $properties = \spec\drupol\CasBundle\Cas::getTestProperties();
        $client = new Psr18Client(\spec\drupol\CasBundle\Cas::getHttpClientMock());
        $cache = new ArrayAdapter();
        $logger = new Logger('cas-bundle');

        $httpFoundationFactory = new HttpFoundationFactory();
        $psr17Factory = new Psr17Factory();

        $cas = new Cas(
            $serverRequest,
            $properties,
            $client,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $cache,
            $logger
        );

        $this
            ->beConstructedWith($cas, $psr17Factory, $psr17Factory, $httpFoundationFactory, $tokenStorage);
    }
}
