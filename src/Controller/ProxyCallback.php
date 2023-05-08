<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Controller;

use EcPhp\CasLib\Contract\CasInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class ProxyCallback
{
    public function __invoke(
        ServerRequestInterface $request,
        CasInterface $cas
    ): ResponseInterface|Response {
        try {
            $response = $cas->handleProxyCallback($request);
        } catch (Throwable) {
            return new Response('', 500);
        }

        return $response;
    }
}
