<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Security\Core\User;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface CasUserInterface.
 */
interface CasUserInterface extends UserInterface
{
    /**
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * @param mixed $default
     *
     * @return mixed
     */
    public function getAttribute(string $key, $default = null);

    /**
     * @return array<array|string>
     */
    public function getAttributes(): array;

    public function getPgt(): ?string;

    public function getUser(): string;
}
