<?php

declare(strict_types=1);

namespace spec\drupol\CasBundle\Controller;

use drupol\CasBundle\Controller\ProxyCallback;
use PhpSpec\ObjectBehavior;

class ProxyCallbackSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ProxyCallback::class);
    }
}
