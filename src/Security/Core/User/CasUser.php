<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Security\Core\User;

use Stringable;
use Symfony\Component\Security\Core\User\UserInterface;

final class CasUser implements CasUserInterface, Stringable
{
    public function __construct(
        private readonly array $payload
    ) {
    }

    public function __toString(): string
    {
        return (string) $this->get('user');
    }

    public function eraseCredentials(): void
    {
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->payload[$key] ?? $default;
    }

    public function getPassword(): ?string
    {
        return null;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function getPgt(): ?string
    {
        return $this->get('proxyGrantingTicket');
    }

    public function getRoles(): array
    {
        return ['ROLE_CAS_AUTHENTICATED'];
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getUserIdentifier(): string
    {
        return $this->get('user');
    }

    public function getUsername(): string
    {
        return $this->get('user');
    }

    public function isEqualTo(UserInterface $user): bool
    {
        return $user->getUserIdentifier() === $this->getUserIdentifier();
    }
}
