<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Cas;

use EcPhp\CasLib\Contract\CasInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

final class SymfonyCas implements SymfonyCasInterface
{
    public function __construct(private readonly CasInterface $cas, private readonly HttpMessageFactoryInterface $httpMessageFactory)
    {
    }

    public function authenticate(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): array {
        return $this
            ->cas
            ->authenticate(
                $this->updateRequest($request),
                $parameters
            );
    }

    public function handleProxyCallback(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): ResponseInterface {
        return $this
            ->cas
            ->handleProxyCallback(
                $this->updateRequest($request),
                $parameters
            );
    }

    public function login(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): ResponseInterface {
        return $this
            ->cas
            ->login(
                $this->updateRequest($request),
                $parameters
            );
    }

    public function logout(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): ResponseInterface {
        return $this
            ->cas
            ->logout(
                $this->updateRequest($request),
                $parameters
            );
    }

    public function process(
        ServerRequestInterface|Request $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        return $this
            ->cas
            ->process(
                $this->updateRequest($request),
                $handler
            );
    }

    public function requestProxyTicket(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): ResponseInterface {
        return $this
            ->cas
            ->requestProxyTicket(
                $this->updateRequest($request),
                $parameters
            );
    }

    public function requestServiceValidate(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): ResponseInterface {
        return $this
            ->cas
            ->requestServiceValidate(
                $this->updateRequest($request),
                $parameters
            );
    }

    public function requestTicketValidation(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): ResponseInterface {
        return $this
            ->cas
            ->requestTicketValidation(
                $this->updateRequest($request),
                $parameters
            );
    }

    public function supportAuthentication(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): bool {
        return $this
            ->cas
            ->supportAuthentication(
                $this->updateRequest($request),
                $parameters
            );
    }

    private function updateRequest(
        ServerRequestInterface|Request $request
    ): ServerRequestInterface {
        return $request instanceof Request
            ? $this->httpMessageFactory->createRequest($request)
            : $request;
    }
}
