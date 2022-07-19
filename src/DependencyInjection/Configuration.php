<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('cas');

        /** @var \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
            ->scalarNode('base_url')->defaultValue('')->end()
            ->arrayNode('protocol')
            ->useAttributeAsKey('name')
            ->arrayPrototype()
            ->children()
            ->scalarNode('path')
            ->isRequired()
            ->cannotBeEmpty()
            ->end()
            ->arrayNode('allowed_parameters')
            ->defaultValue([])
            ->scalarPrototype()->end()
            ->end()
            ->arrayNode('default_parameters')
            ->defaultValue([])
            ->scalarPrototype()->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
