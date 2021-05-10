<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\EcPhp\CasBundle\Controller;

use EcPhp\CasBundle\Controller\Homepage;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpFoundation\Response;

class HomepageSpec extends ObjectBehavior
{
    public function it_can_return_a_response()
    {
        $this
            ->__invoke()
            ->shouldBeAnInstanceOf(Response::class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Homepage::class);
    }
}
