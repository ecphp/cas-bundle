<?php

declare(strict_types=1);

namespace spec\EcPhp\CasBundle\Controller;

use EcPhp\CasBundle\Controller\Login;
use PhpSpec\ObjectBehavior;

class LoginSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Login::class);
    }
}
