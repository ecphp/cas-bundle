<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use EcPhp\CasBundle\Configuration\Symfony;
use EcPhp\CasBundle\Controller\Homepage;
use EcPhp\CasBundle\Controller\Login;
use EcPhp\CasBundle\Controller\Logout;
use EcPhp\CasBundle\Controller\ProxyCallback;
use EcPhp\CasBundle\Security\CasGuardAuthenticator;
use EcPhp\CasBundle\Security\Core\User\CasUserProvider;
use EcPhp\CasLib\Cas;
use EcPhp\CasLib\CasInterface;
use EcPhp\CasLib\Configuration\PropertiesInterface;
use EcPhp\CasLib\Introspection\Contract\IntrospectorInterface;
use EcPhp\CasLib\Introspection\Introspector;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\RequestStack;

return static function (ContainerConfigurator $container) {
    $container
        ->services()
        ->set('cas', Cas::class)
        ->autowire()
        ->autoconfigure();

    $container
        ->services()
        ->alias(CasInterface::class, 'cas');

    $container
        ->services()
        ->set('cas.configuration', Symfony::class)
        ->args([
            '%cas%',
            service('router'),
        ]);

    $container
        ->services()
        ->set('cas.introspector', Introspector::class);

    $container
        ->services()
        ->alias(IntrospectorInterface::class, 'cas.introspector');

    $container
        ->services()
        ->set('cas.userprovider', CasUserProvider::class)
        ->autowire();

    $container
        ->services()
        ->set('cas.guardauthenticator', CasGuardAuthenticator::class)
        ->autowire(true)
        ->autoconfigure(true);

    $container
        ->services()
        ->set(Homepage::class)
        ->autowire(true)
        ->autoconfigure(true)
        ->tag('controller.service_arguments');

    $container
        ->services()
        ->set(Login::class)
        ->autowire(true)
        ->autoconfigure(true)
        ->tag('controller.service_arguments');

    $container
        ->services()
        ->set(Logout::class)
        ->autowire(true)
        ->autoconfigure(true)
        ->tag('controller.service_arguments');

    $container
        ->services()
        ->set(ProxyCallback::class)
        ->autowire(true)
        ->autoconfigure(true)
        ->tag('controller.service_arguments');

    $container
        ->services()
        ->set('symfony.request', RequestStack::class)
        ->factory([
            service('request_stack'),
            'getCurrentRequest',
        ])
        ->private();

    $container
        ->services()
        ->set(ServerRequestInterface::class)
        ->factory([
            service('Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface'),
            'createRequest',
        ])
        ->args([
            service('symfony.request'),
        ]);

    $container
        ->services()
        ->alias('psr.request', RequestInterface::class);

    $container
        ->services()
        ->alias('psr.request', ServerRequestInterface::class);

    $container
        ->services()
        ->alias(PropertiesInterface::class, 'cas.configuration');
};
