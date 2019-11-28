<?php

declare(strict_types=1);

namespace spec\drupol\CasBundle\Controller;

use drupol\CasBundle\Controller\Login;
use PhpSpec\ObjectBehavior;

class LoginSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Login::class);
    }
}
