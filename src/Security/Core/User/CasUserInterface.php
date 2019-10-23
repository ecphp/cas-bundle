<?php

declare(strict_types=1);

namespace drupol\CasBundle\Security\Core\User;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface CasUserInterface.
 */
interface CasUserInterface extends UserInterface
{
    /**
     * @param string $key
     * @param null $default
     *
     * @return string|null
     */
    public function get(string $key, $default = null);

    /**
     * @param string $key
     * @param null $default
     *
     * @return mixed
     */
    public function getAttribute(string $key, $default = null);

    /**
     * @return array
     */
    public function getAttributes(): array;

    /**
     * @return string|null
     */
    public function getPgt(): ?string;

    /**
     * @return string
     */
    public function getUser(): string;
}
