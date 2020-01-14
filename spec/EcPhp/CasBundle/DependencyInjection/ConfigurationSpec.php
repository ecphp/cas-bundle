<?php

declare(strict_types=1);

namespace spec\EcPhp\CasBundle\DependencyInjection;

use EcPhp\CasBundle\DependencyInjection\Configuration;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class ConfigurationSpec extends ObjectBehavior
{
    public function it_can_use_a_specific_configuration()
    {
        $this
            ->getConfigTreeBuilder()
            ->shouldBeAnInstanceOf(TreeBuilder::class);

        $this
            ->getConfigTreeBuilder()
            ->getRootNode()
            ->shouldBeAnInstanceOf(NodeDefinition::class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Configuration::class);
    }
}
