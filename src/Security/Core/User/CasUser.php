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
    public function getPassword(): ?string
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
    public function getRoles(): array
    {
        return ['ROLE_CAS_AUTHENTICATED'];
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(): string
    {
        trigger_deprecation(
            'ecphp/cas-bundle',
            '2.1.2',
            'The method "%s::getUser()" is deprecated, use %s::getUsername() instead.',
            CasUserInterface::class
        );

        return $this->getUsername();
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername(): string
    {
        return $this->get('user');
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
