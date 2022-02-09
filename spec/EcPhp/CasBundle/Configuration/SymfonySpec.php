<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace spec\EcPhp\CasBundle\Configuration;

use EcPhp\CasBundle\Configuration\Symfony;
use PhpSpec\ObjectBehavior;
use spec\EcPhp\CasBundle\Cas;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\Routing\RouterInterface;

class SymfonySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Symfony::class);
    }

    public function it_replace_symfony_routes_into_proper_urls(RouterInterface $router)
    {
        $testProperties = Cas::getTestProperties()->all();

        $properties = [
            'cas' => $testProperties,
        ];

        $properties['cas']['protocol']['login']['default_parameters']['service'] = 'symfony_route_login';
        $properties['cas']['protocol']['logout']['default_parameters']['service'] = 'symfony_route_logout';
        $properties['cas']['protocol']['serviceValidate']['default_parameters']['pgtUrl'] = 'symfony_route_pgtUrl';

        $router
            ->generate('symfony_route_login', [], RouterInterface::ABSOLUTE_URL)
            ->willReturn('http://login');
        $router
            ->generate('symfony_route_logout', [], RouterInterface::ABSOLUTE_URL)
            ->willReturn('http://logout');
        $router
            ->generate('symfony_route_pgtUrl', [], RouterInterface::ABSOLUTE_URL)
            ->willReturn('http://serviceValidate');

        $parameterBag = new ParameterBag($properties);

        $this->beConstructedWith($parameterBag, $router);

        $updatedProperties = array_merge_recursive(
            $testProperties,
            [
                'protocol' => [
                    'login' => [
                        'default_parameters' => [
                            'service' => 'http://login',
                        ],
                    ],
                    'logout' => [
                        'default_parameters' => [
                            'service' => 'http://logout',
                        ],
                    ],
                    'serviceValidate' => [
                        'default_parameters' => [
                            'pgtUrl' => 'http://serviceValidate',
                        ],
                    ],
                ],
            ]
        );

        $this
            ->all()
            ->shouldReturn($updatedProperties);
    }

    public function let(RouterInterface $router)
    {
        $properties = [
            'cas' => Cas::getTestProperties()->all(),
        ];

        $parameterBag = new ParameterBag($properties);

        $this
            ->beConstructedWith($parameterBag, $router);
    }
}
