<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use EcPhp\CasBundle\Controller\Homepage;
use EcPhp\CasBundle\Controller\Login;
use EcPhp\CasBundle\Controller\Logout;
use EcPhp\CasBundle\Controller\ProxyCallback;

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
