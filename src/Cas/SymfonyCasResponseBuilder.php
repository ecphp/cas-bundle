<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Cas;

use EcPhp\CasLib\Contract\Response\CasResponseBuilderInterface;
use EcPhp\CasLib\Contract\Response\CasResponseInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Component\HttpFoundation\Response;

final class SymfonyCasResponseBuilder implements SymfonyCasResponseBuilderInterface
{
    public function __construct(private readonly CasResponseBuilderInterface $casResponseBuilder, private readonly HttpMessageFactoryInterface $httpMessageFactory)
    {
    }

    public function fromResponse(ResponseInterface|Response $response): CasResponseInterface
    {
        if ($response instanceof Response) {
            $response = $this->httpMessageFactory->createResponse($response);
        }

        return $this->casResponseBuilder->fromResponse($response);
    }
}
