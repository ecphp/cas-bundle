<?php

declare(strict_types=1);

use EcPhp\CasBundle\Controller\Homepage;
use EcPhp\CasBundle\Controller\Login;
use EcPhp\CasBundle\Controller\Logout;
use EcPhp\CasBundle\Controller\ProxyCallback;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routes) {
    $routes
        ->add('cas_bundle_homepage', '/homepage')
        ->controller(Homepage::class);

    $routes
        ->add('cas_bundle_login', '/login')
        ->controller(Login::class);

    $routes
        ->add('cas_bundle_logout', '/logout')
        ->controller(Logout::class);

    $routes
        ->add('cas_bundle_proxy_callback', '/proxy/callback')
        ->controller(ProxyCallback::class);
};
