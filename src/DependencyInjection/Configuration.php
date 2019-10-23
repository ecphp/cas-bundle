<?php

declare(strict_types=1);

namespace drupol\CasBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * @see http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
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
