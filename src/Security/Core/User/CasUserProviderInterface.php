<?php

declare(strict_types=1);

namespace drupol\CasBundle\Security\Core\User;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Interface CasUserProviderInterface.
 */
interface CasUserProviderInterface extends UserProviderInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \drupol\CasBundle\Security\Core\User\CasUser
     */
    public function loadUserByResponse(ResponseInterface $response): CasUserInterface;
}
