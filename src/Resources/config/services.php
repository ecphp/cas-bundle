<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use EcPhp\CasBundle\Configuration\Symfony;
use EcPhp\CasBundle\Controller\Homepage;
use EcPhp\CasBundle\Controller\Login;
use EcPhp\CasBundle\Controller\Logout;
use EcPhp\CasBundle\Controller\ProxyCallback;
use EcPhp\CasBundle\Security\CasAuthenticator;
use EcPhp\CasBundle\Security\Core\User\CasUserProvider;
use EcPhp\CasLib\Cas;
use EcPhp\CasLib\CasInterface;
use EcPhp\CasLib\Configuration\PropertiesInterface;
use EcPhp\CasLib\Introspection\Contract\IntrospectorInterface;
use EcPhp\CasLib\Introspection\Introspector;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;

return static function (ContainerConfigurator $container): void {
    $services = $container
        ->services()
        ->defaults()
        ->autoconfigure(true)
        ->autowire(true);

    $services
        ->set('cas', Cas::class);

    $services
        ->alias(CasInterface::class, 'cas');

    $services
        ->set('cas.configuration', Symfony::class);

    $services
        ->set('cas.introspector', Introspector::class);

    $services
        ->set('cas.userprovider', CasUserProvider::class);

    $services
        ->alias(IntrospectorInterface::class, 'cas.introspector');

    $services
        ->set('cas.authenticator', CasAuthenticator::class);

    $services
        ->set(Homepage::class)
        ->tag('controller.service_arguments');

    $services
        ->set(Login::class)
        ->tag('controller.service_arguments');

    $services
        ->set(Logout::class)
        ->tag('controller.service_arguments');

    $services
        ->set(ProxyCallback::class)
        ->tag('controller.service_arguments');

    $services
        ->alias(PropertiesInterface::class, 'cas.configuration');

    /**
     * All of this needs to be removed for the next major
     * version of ecphp/cas-lib
     * A request or server request is not a service, it is
     * stateful and should not live in the container.
     */
    $services
        ->set(RequestInterface::class)
        ->factory([
            service('request_stack'),
            'getCurrentRequest',
        ])
        ->private();

    $services
        ->set(ServerRequestInterface::class)
        ->factory([
            service(HttpMessageFactoryInterface::class),
            'createRequest',
        ])
        ->args([
            service(RequestInterface::class),
        ]);
};
