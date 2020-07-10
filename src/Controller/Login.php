<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Controller;

use EcPhp\CasLib\CasInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

/**
 * Class Login.
 */
final class Login
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \EcPhp\CasLib\CasInterface $cas
     * @param \Symfony\Component\Security\Core\Security $security
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function __invoke(
        Request $request,
        CasInterface $cas,
        Security $security
    ): RedirectResponse {
        $parameters = $request->query->all() + [
            'renew' => null !== $security->getUser(),
        ];

        if (null !== $response = $cas->login($parameters)) {
            return new RedirectResponse($response->getHeaderLine('location'));
        }

        return new RedirectResponse('/');
    }
}
