<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Security\Core\User;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * @template-extends UserProviderInterface<CasUserInterface>
 */
interface CasUserProviderInterface extends UserProviderInterface
{
    public function loadUserByResponse(Response $response): CasUserInterface;
}
