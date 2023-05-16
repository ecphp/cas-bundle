<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace spec\EcPhp\CasBundle\Controller;

use EcPhp\CasBundle\Controller\ProxyCallback;
use EcPhp\CasLib\Contract\CasInterface;
use Nyholm\Psr7\ServerRequest;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;

class ProxyCallbackSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ProxyCallback::class);
    }

    public function it_returns_a_statuscode_200_when_pgtIou_and_pgtId_are_available(
        CasInterface $cas,
        ResponseInterface $response
    ) {
        $request = new ServerRequest('GET', 'http://local/cas/proxy?pgtIou=pgtIou&pgtId=pgtId');

        $response
            ->getStatusCode()
            ->willReturn(200);

        $cas
            ->handleProxyCallback(
                $request,
            )
            ->willReturn($response);

        $response = $this->__invoke($request, $cas);

        $response
            ->shouldBeAnInstanceOf(ResponseInterface::class);

        $response
            ->getStatusCode()
            ->shouldReturn(200);
    }

    public function it_returns_a_statuscode_500_when_missing_pgtId(
        CasInterface $cas,
        ResponseInterface $response
    ) {
        $request = new ServerRequest('GET', 'http://local/cas/proxy?pgtIou=pgtIou');

        $response
            ->getStatusCode()
            ->willReturn(500);

        $cas
            ->handleProxyCallback(
                $request
            )
            ->willReturn($response);

        $this
            ->__invoke($request, $cas)
            ->shouldBeAnInstanceOf(ResponseInterface::class);

        $response = $this->__invoke($request, $cas);

        $response
            ->getStatusCode()
            ->shouldReturn(500);
    }

    public function it_returns_a_statuscode_500_when_missing_pgtId_and_pgtIou(
        CasInterface $cas,
        ResponseInterface $response
    ) {
        $request = new ServerRequest('GET', 'http://local/cas/proxy');

        $response
            ->getStatusCode()
            ->willReturn(500);

        $cas
            ->handleProxyCallback(
                $request
            )
            ->willReturn($response);

        $response = $this->__invoke($request, $cas);

        $response
            ->shouldBeAnInstanceOf(ResponseInterface::class);

        $response
            ->getStatusCode()
            ->shouldReturn(500);
    }

    public function it_returns_a_statuscode_500_when_missing_pgtIou(
        CasInterface $cas,
        ResponseInterface $response
    ) {
        $request = new ServerRequest('GET', 'http://local/cas/proxy?pgtId=pgtId');

        $response
            ->getStatusCode()
            ->willReturn(500);

        $cas
            ->handleProxyCallback(
                $request
            )
            ->willReturn($response);

        $response = $this->__invoke($request, $cas);

        $response
            ->shouldBeAnInstanceOf(ResponseInterface::class);

        $response
            ->getStatusCode()
            ->shouldReturn(500);
    }
}
