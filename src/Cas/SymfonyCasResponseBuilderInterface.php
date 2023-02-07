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
use EcPhp\CasLib\Exception\CasResponseBuilderException;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

interface SymfonyCasResponseBuilderInterface extends CasResponseBuilderInterface
{
    /**
     * @throws CasResponseBuilderException
     */
    public function fromResponse(ResponseInterface|Response $response): CasResponseInterface;
}
