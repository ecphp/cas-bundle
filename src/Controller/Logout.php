<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Controller;

use EcPhp\CasLib\CasInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class Logout
{
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
