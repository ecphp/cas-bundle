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
use Symfony\Component\HttpFoundation\Request;

interface SymfonyCasInterface extends CasInterface
{
    public function authenticate(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): array;

    public function handleProxyCallback(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): ResponseInterface;

    public function login(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): ResponseInterface;

    public function logout(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): ResponseInterface;

    public function process(
        ServerRequestInterface|Request $request,
        RequestHandlerInterface $handler
    ): ResponseInterface;

    public function requestProxyTicket(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): ResponseInterface;

    public function requestServiceValidate(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): ResponseInterface;

    public function requestTicketValidation(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): ResponseInterface;

    public function supportAuthentication(
        ServerRequestInterface|Request $request,
        array $parameters = []
    ): bool;
}
