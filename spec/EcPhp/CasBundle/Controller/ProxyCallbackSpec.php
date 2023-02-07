<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace spec\EcPhp\CasBundle\Controller;

use EcPhp\CasBundle\Cas\SymfonyCasInterface;
use EcPhp\CasBundle\Controller\ProxyCallback;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;

class ProxyCallbackSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ProxyCallback::class);
    }

    public function it_returns_a_statuscode_200_when_pgtIou_and_pgtId_are_available(
        SymfonyCasInterface $cas,
        ResponseInterface $response
    ) {
        $request = Request::create('http://local/cas/proxy?pgtIou=pgtIou&pgtId=pgtId');

        $response
            ->getStatusCode()
            ->willReturn(200);

        $cas
            ->handleProxyCallback(
                $request,
                [
                    'pgtIou' => 'pgtIou',
                    'pgtId' => 'pgtId',
                ]
            )
            ->willReturn($response);

        $this
            ->__invoke($request, $cas)
            ->shouldBeAnInstanceOf(ResponseInterface::class);

        $this
            ->__invoke($request, $cas)
            ->getStatusCode()
            ->shouldReturn(200);
    }

    public function it_returns_a_statuscode_500_when_missing_pgtId(
        SymfonyCasInterface $cas,
        ResponseInterface $response
    ) {
        $request = Request::create('http://local/cas/proxy?pgtIou=pgtIou');

        $response
            ->getStatusCode()
            ->willReturn(500);

        $cas
            ->handleProxyCallback(
                $request,
                [
                    'pgtIou' => 'pgtIou',
                ]
            )
            ->willReturn($response);

        $this
            ->__invoke($request, $cas)
            ->shouldBeAnInstanceOf(ResponseInterface::class);

        $this
            ->__invoke($request, $cas)
            ->getStatusCode()
            ->shouldReturn(500);
    }

    public function it_returns_a_statuscode_500_when_missing_pgtId_and_pgtIou(
        SymfonyCasInterface $cas,
        ResponseInterface $response
    ) {
        $request = Request::create('');

        $response
            ->getStatusCode()
            ->willReturn(500);

        $cas
            ->handleProxyCallback(
                $request,
                []
            )
            ->willReturn($response);

        $this
            ->__invoke($request, $cas)
            ->shouldBeAnInstanceOf(ResponseInterface::class);

        $this
            ->__invoke($request, $cas)
            ->getStatusCode()
            ->shouldReturn(500);
    }

    public function it_returns_a_statuscode_500_when_missing_pgtIou(
        SymfonyCasInterface $cas,
        ResponseInterface $response
    ) {
        $request = Request::create('http://local/cas/proxy?pgtId=pgtId');

        $response
            ->getStatusCode()
            ->willReturn(500);

        $cas
            ->handleProxyCallback(
                $request,
                [
                    'pgtId' => 'pgtId',
                ]
            )
            ->willReturn($response);

        $this
            ->__invoke($request, $cas)
            ->shouldBeAnInstanceOf(ResponseInterface::class);

        $this
            ->__invoke($request, $cas)
            ->getStatusCode()
            ->shouldReturn(500);
    }
}
