<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Controller;

use EcPhp\CasLib\CasInterface;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ProxyCallback.
 */
final class ProxyCallback extends AbstractController
{
    /**
     * @param \EcPhp\CasLib\CasInterface $casProtocol
     * @param \Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface $httpFoundationFactory
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(CasInterface $casProtocol, HttpFoundationFactoryInterface $httpFoundationFactory)
    {
        return $httpFoundationFactory->createResponse($casProtocol->handleProxyCallback());
    }
}
