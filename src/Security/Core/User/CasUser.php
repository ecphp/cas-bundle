<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Security\Core\User;

/**
 * Class CasUser.
 */
final class CasUser implements CasUserInterface
{
    /**
     * The user storage.
     *
     * @var array<mixed>
     */
    private $storage;

    /**
     * CasUser constructor.
     *
     * @param array<mixed> $data
     */
    public function __construct(array $data)
    {
        $this->storage = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key, $default = null)
    {
        return $this->getStorage()[$key] ?? $default;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttribute(string $key, $default = null)
    {
        return $this->getStorage()['attributes'][$key] ?? $default;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes(): array
    {
        return $this->get('attributes', []);
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getPgt(): ?string
    {
        return $this->get('proxyGrantingTicket');
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return ['ROLE_CAS_AUTHENTICATED'];
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(): string
    {
        return $this->get('user');
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->getUser();
    }

    /**
     * Get the storage.
     *
     * @return array<mixed>
     */
    private function getStorage()
    {
        return $this->storage;
    }
}
