<?php

declare(strict_types=1);

namespace spec\drupol\CasBundle\DependencyInjection;

use drupol\CasBundle\DependencyInjection\CasExtension;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CasExtensionSpec extends ObjectBehavior
{
    public function it_can_load_stuff_in_the_container(ContainerBuilder $containerBuilder)
    {
        $configs = [
            [
                'base_url' => 'base_url',
            ],
        ];

        $this
            ->load($configs, $containerBuilder);

        $containerBuilder
            ->setParameter('cas', ['base_url' => 'base_url', 'protocol' => []])
            ->shouldHaveBeenCalledOnce();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CasExtension::class);
    }
}
