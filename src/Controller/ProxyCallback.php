<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Controller;

use EcPhp\CasLib\CasInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ProxyCallback
{
    /**
     * @return ResponseInterface|Response
     */
    public function __invoke(
        Request $request,
        CasInterface $cas
    ) {
        return (null === $response = $cas->handleProxyCallback($request->query->all()))
            ? (new Response('', 500))
            : $response;
    }
}
