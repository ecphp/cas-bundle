<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routes) {
    $routes
        ->import('@CasBundle/Resources/config/routes/routes.php')
        ->prefix('/cas');
};
