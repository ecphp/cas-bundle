<?php

declare(strict_types=1);

namespace spec\drupol\CasBundle\Controller;

use drupol\CasBundle\Controller\ProxyCallback;
use drupol\psrcas\Cas;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\ServerRequest;
use PhpSpec\ObjectBehavior;
use Psr\Log\NullLogger;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\HttpClient\Psr18Client;
use Symfony\Component\HttpFoundation\Response;

class ProxyCallbackSpec extends ObjectBehavior
{
    public function it_can_be_invoked()
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

        $httpFoundationFactory = new HttpFoundationFactory();

        $this
            ->__invoke($cas, $httpFoundationFactory)
            ->shouldBeAnInstanceOf(Response::class);

        $this
            ->__invoke($cas, $httpFoundationFactory)
            ->getStatusCode()
            ->shouldReturn(200);

        $serverRequest = new ServerRequest('GET', 'http://local/cas/proxy?pgtIou=pgtIou&pgtId=pgtId');
        $this
            ->__invoke($cas, $httpFoundationFactory)
            ->shouldBeAnInstanceOf(Response::class);
        $this
            ->__invoke($cas->withServerRequest($serverRequest), $httpFoundationFactory)
            ->getStatusCode()
            ->shouldReturn(200);

        $serverRequest = new ServerRequest('GET', 'http://local/cas/proxy?pgtIou=pgtIou');
        $this
            ->__invoke($cas, $httpFoundationFactory)
            ->shouldBeAnInstanceOf(Response::class);
        $this
            ->__invoke($cas->withServerRequest($serverRequest), $httpFoundationFactory)
            ->getStatusCode()
            ->shouldReturn(500);

        $serverRequest = new ServerRequest('GET', 'http://local/cas/proxy?pgtId=pgtId');
        $this
            ->__invoke($cas, $httpFoundationFactory)
            ->shouldBeAnInstanceOf(Response::class);
        $this
            ->__invoke($cas->withServerRequest($serverRequest), $httpFoundationFactory)
            ->getStatusCode()
            ->shouldReturn(500);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(ProxyCallback::class);
    }
}
