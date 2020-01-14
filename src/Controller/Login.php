<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Controller;

use EcPhp\CasLib\CasInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Login.
 */
final class Login extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \EcPhp\CasLib\CasInterface $cas
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(
        Request $request,
        CasInterface $cas
    ) {
        $parameters = $request->query->all() + [
            'renew' => null !== $this->getUser(),
        ];

        if (null !== $response = $cas->login($parameters)) {
            return new RedirectResponse($response->getHeaderLine('location'));
        }

        return new RedirectResponse('/');
    }
}
