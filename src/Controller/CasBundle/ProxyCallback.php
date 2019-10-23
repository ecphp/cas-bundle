<?php

declare(strict_types=1);

namespace drupol\CasBundle\Controller\CasBundle;

use drupol\psrcas\CasInterface;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ProxyCallback.
 */
final class ProxyCallback extends AbstractController
{
    /**
     * @param \drupol\psrcas\CasInterface $casProtocol
     * @param \Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface $httpFoundationFactory
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(CasInterface $casProtocol, HttpFoundationFactoryInterface $httpFoundationFactory)
    {
        return $httpFoundationFactory->createResponse($casProtocol->handleProxyCallback());
    }
}
