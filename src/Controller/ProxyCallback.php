<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Controller;

use EcPhp\CasBundle\Cas\SymfonyCasInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class ProxyCallback
{
    public function __invoke(
        Request $request,
        SymfonyCasInterface $cas
    ): ResponseInterface|Response {
        try {
            $response = $cas
                ->handleProxyCallback(
                    $request,
                    $request->query->all()
                );
        } catch (Throwable) {
            return new Response('', 500);
        }

        return $response;
    }
}
