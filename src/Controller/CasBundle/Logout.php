<?php

declare(strict_types=1);

namespace drupol\CasBundle\Controller\CasBundle;

use drupol\psrcas\CasInterface;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Logout.
 */
final class Logout extends AbstractController
{
    /**
     * @param \drupol\psrcas\CasInterface $cas
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage
     * @param \Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface $httpFoundationFactory
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(
        CasInterface $cas,
        TokenStorageInterface $tokenStorage,
        HttpFoundationFactoryInterface $httpFoundationFactory
    ) {
        if (null !== $response = $cas->logout()) {
            $tokenStorage->setToken();

            return $httpFoundationFactory->createResponse($response);
        }

        return new RedirectResponse('/');
    }
}
