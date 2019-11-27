<?php

declare(strict_types=1);

namespace spec\drupol\CasBundle\Security;

use drupol\CasBundle\Security\CasGuardAuthenticator;
use drupol\psrcas\Cas;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\ServerRequest;
use PhpSpec\ObjectBehavior;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\HttpClient\Psr18Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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
