<?php

declare(strict_types=1);

namespace spec\drupol\CasBundle\Controller;

use drupol\CasBundle\Controller\Logout;
use PhpSpec\ObjectBehavior;

class LogoutSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Logout::class);
    }
}
