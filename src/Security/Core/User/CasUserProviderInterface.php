<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Security\Core\User;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

interface CasUserProviderInterface extends UserProviderInterface
{
    public function loadUserByResponse(ResponseInterface $response): CasUserInterface;
}
