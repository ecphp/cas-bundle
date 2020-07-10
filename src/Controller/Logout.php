<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Controller;

use EcPhp\CasLib\CasInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Logout.
 */
final class Logout
{
    /**
     * @param \EcPhp\CasLib\CasInterface $cas
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function __invoke(
        CasInterface $cas,
        TokenStorageInterface $tokenStorage
    ): RedirectResponse {
        if (null !== $response = $cas->logout()) {
            $tokenStorage->setToken();

            return new RedirectResponse($response->getHeaderLine('location'));
        }

        return new RedirectResponse('/');
    }
}
