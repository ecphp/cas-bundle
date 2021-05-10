<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Security\Core\User;

use Symfony\Component\Security\Core\User\UserInterface;

final class CasUser implements CasUserInterface
{
    /**
     * The user storage.
     *
     * @var array<mixed>
     */
    private array $storage;

    /**
     * CasUser constructor.
     *
     * @param array<mixed> $data
     */
    public function __construct(array $data)
    {
        $this->storage = $data;
    }

    public function eraseCredentials(): void
    {
    }

    public function get(string $key, $default = null)
    {
        return $this->getStorage()[$key] ?? $default;
    }

    public function getAttribute(string $key, $default = null)
    {
        return $this->getStorage()['attributes'][$key] ?? $default;
    }

    public function getAttributes(): array
    {
        return $this->get('attributes', []);
    }

    public function getPassword(): ?string
    {
        return null;
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

    public function getUsername(): string
    {
        return $this->get('user');
    }

    public function isEqualTo(UserInterface $user)
    {
        return $user->getUsername() === $this->getUsername();
    }

    /**
     * Get the storage.
     *
     * @return array<mixed>
     */
    private function getStorage(): array
    {
        return $this->storage;
    }
}
