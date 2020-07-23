<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Controller;

use EcPhp\CasLib\CasInterface;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Component\HttpFoundation\Response;

final class ProxyCallback
{
    public function __invoke(
        CasInterface $casProtocol,
        HttpFoundationFactoryInterface $httpFoundationFactory
    ): Response {
        if (null !== $response = $casProtocol->handleProxyCallback()) {
            return $httpFoundationFactory->createResponse($response);
        }

        return new Response('', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
