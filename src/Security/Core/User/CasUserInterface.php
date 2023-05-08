<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Security\Core\User;

use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface CasUserInterface extends EquatableInterface, UserInterface
{
    public function __toString(): string;

    public function get(string $key, mixed $default = null): mixed;

    public function getPayload(): array;

    public function getPgt(): ?string;
}
