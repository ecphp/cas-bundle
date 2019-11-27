<?php

declare(strict_types=1);

namespace spec\drupol\CasBundle\Controller;

use drupol\CasBundle\Controller\Homepage;
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
