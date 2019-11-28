<?php

declare(strict_types=1);

namespace spec\drupol\CasBundle\Controller;

use drupol\CasBundle\Controller\Logout;
use drupol\psrcas\Cas;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\ServerRequest;
use PhpSpec\ObjectBehavior;
use Psr\Log\NullLogger;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\HttpClient\Psr18Client;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LogoutSpec extends ObjectBehavior
{
    public function it_can_be_invoked(TokenStorageInterface $tokenStorage)
    {
        $serverRequest = new ServerRequest('GET', 'http://app');
        $properties = \spec\drupol\CasBundle\Cas::getTestProperties();
        $client = new Psr18Client(\spec\drupol\CasBundle\Cas::getHttpClientMock());
        $cache = new ArrayAdapter();
        $logger = new NullLogger();

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
            ->__invoke($cas, $tokenStorage)
            ->shouldBeAnInstanceOf(RedirectResponse::class);

        $this
            ->__invoke($cas, $tokenStorage)
            ->headers
            ->get('location')
            ->shouldReturn('http://local/cas/logout');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Logout::class);
    }
}
