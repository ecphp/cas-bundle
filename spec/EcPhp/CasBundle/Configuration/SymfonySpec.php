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
use Symfony\Component\Routing\RouterInterface;

class SymfonySpec extends ObjectBehavior
{
    public function it_implements_array_access()
    {
        $this
            ->offsetExists('protocol')
            ->shouldReturn(true);
        $this
            ->offsetGet('base_url')
            ->shouldReturn('http://local/cas');

        $this
            ->offsetUnset('protocol');

        $this
            ->offsetExists('protocol')
            ->shouldReturn(false);

        $this
            ->offsetSet('base_url', 'base_url');

        $this
            ->offsetGet('base_url')
            ->shouldReturn('base_url');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Symfony::class);
    }

    public function it_replace_symfony_routes_into_proper_urls()
    {
        $properties = Cas::getTestProperties()->all();
        $properties['protocol']['login']['default_parameters']['service'] = 'http://login';
        $properties['protocol']['logout']['default_parameters']['service'] = 'http://logout';
        $properties['protocol']['serviceValidate']['default_parameters']['pgtUrl'] = 'http://serviceValidate';

        $this
            ->all()
            ->shouldReturn($properties);
    }

    public function let(RouterInterface $router)
    {
        $properties = Cas::getTestProperties()->all();

        $properties['protocol']['login']['default_parameters']['service'] = 'symfony_route_login';
        $properties['protocol']['logout']['default_parameters']['service'] = 'symfony_route_logout';
        $properties['protocol']['serviceValidate']['default_parameters']['pgtUrl'] = 'symfony_route_pgtUrl';

        $router
            ->generate('symfony_route_login', [], RouterInterface::ABSOLUTE_URL)
            ->willReturn('http://login');
        $router
            ->generate('symfony_route_logout', [], RouterInterface::ABSOLUTE_URL)
            ->willReturn('http://logout');
        $router
            ->generate('symfony_route_pgtUrl', [], RouterInterface::ABSOLUTE_URL)
            ->willReturn('http://serviceValidate');

        $this
            ->beConstructedWith($properties, $router);
    }
}
