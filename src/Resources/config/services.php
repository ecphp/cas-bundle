<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use EcPhp\CasBundle\Cas\SymfonyCas;
use EcPhp\CasBundle\Cas\SymfonyCasInterface;
use EcPhp\CasBundle\Cas\SymfonyCasResponseBuilder;
use EcPhp\CasBundle\Cas\SymfonyCasResponseBuilderInterface;
use EcPhp\CasBundle\Configuration\Symfony;
use EcPhp\CasBundle\Controller\Homepage;
use EcPhp\CasBundle\Controller\Login;
use EcPhp\CasBundle\Controller\Logout;
use EcPhp\CasBundle\Controller\ProxyCallback;
use EcPhp\CasBundle\Security\CasAuthenticator;
use EcPhp\CasBundle\Security\CasEntryPoint;
use EcPhp\CasBundle\Security\Core\User\CasUserProvider;
use EcPhp\CasBundle\Security\Core\User\CasUserProviderInterface;
use EcPhp\CasLib\Cas;
use EcPhp\CasLib\Contract\CasInterface;
use EcPhp\CasLib\Contract\Configuration\PropertiesInterface;
use EcPhp\CasLib\Contract\Response\CasResponseBuilderInterface;
use EcPhp\CasLib\Contract\Response\Factory\AuthenticationFailureFactory as FactoryAuthenticationFailureFactory;
use EcPhp\CasLib\Contract\Response\Factory\ProxyFactory as FactoryProxyFactory;
use EcPhp\CasLib\Contract\Response\Factory\ProxyFailureFactory as FactoryProxyFailureFactory;
use EcPhp\CasLib\Contract\Response\Factory\ServiceValidateFactory as FactoryServiceValidateFactory;
use EcPhp\CasLib\Response\CasResponseBuilder;
use EcPhp\CasLib\Response\Factory\AuthenticationFailureFactory;
use EcPhp\CasLib\Response\Factory\ProxyFactory;
use EcPhp\CasLib\Response\Factory\ProxyFailureFactory;
use EcPhp\CasLib\Response\Factory\ServiceValidateFactory;
use Symfony\Component\Security\Core\User\UserProviderInterface;

return static function (ContainerConfigurator $container): void {
    $services = $container
        ->services()
        ->defaults()
        ->autoconfigure(true)
        ->autowire(true);

    $services->set(Cas::class);
    $services->alias(CasInterface::class, Cas::class);

    $services
        ->set(SymfonyCas::class)
        ->decorate(CasInterface::class)
        ->arg('$cas', service('.inner'));
    $services->alias(SymfonyCasInterface::class, SymfonyCas::class);

    $services
        ->set(CasResponseBuilder::class);
    $services->alias(CasResponseBuilderInterface::class, CasResponseBuilder::class);

    $services
        ->set(SymfonyCasResponseBuilder::class)
        ->decorate(CasResponseBuilderInterface::class)
        ->arg('$casResponseBuilder', service('.inner'));
    $services->alias(SymfonyCasResponseBuilderInterface::class, SymfonyCasResponseBuilder::class);

    $services->set(Symfony::class);
    $services->alias(PropertiesInterface::class, Symfony::class);

    $services->set(CasUserProvider::class);
    $services->alias(CasUserProviderInterface::class, CasUserProvider::class);
    $services->alias(UserProviderInterface::class, CasUserProvider::class);

    $services->set(CasAuthenticator::class);

    $services
        ->set(AuthenticationFailureFactory::class);
    $services->alias(FactoryAuthenticationFailureFactory::class, AuthenticationFailureFactory::class);

    $services
        ->set(ProxyFactory::class);
    $services->alias(FactoryProxyFactory::class, ProxyFactory::class);

    $services
        ->set(ProxyFailureFactory::class);
    $services->alias(FactoryProxyFailureFactory::class, ProxyFailureFactory::class);

    $services
        ->set(ServiceValidateFactory::class);
    $services->alias(FactoryServiceValidateFactory::class, ServiceValidateFactory::class);

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
        ->set(CasEntryPoint::class);
};
