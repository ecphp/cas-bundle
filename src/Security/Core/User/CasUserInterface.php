<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Security\Core\User;

use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface CasUserInterface extends EquatableInterface, UserInterface
{
    /**
     * @param mixed $default
     *
     * @return mixed|null
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
}
