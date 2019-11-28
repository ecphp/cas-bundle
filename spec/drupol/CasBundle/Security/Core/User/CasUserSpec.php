<?php

declare(strict_types=1);

namespace spec\drupol\CasBundle\Security\Core\User;

use drupol\CasBundle\Security\Core\User\CasUser;
use LogicException;
use PhpSpec\ObjectBehavior;

class CasUserSpec extends ObjectBehavior
{
    public function it_can_get_its_username()
    {
        $this
            ->getUser()
            ->shouldBeString();

        $this
            ->getUser()
            ->shouldBeEqualTo($this->getUsername());
    }

    public function it_can_get_one_attribute()
    {
        $this
            ->getAttribute('foo')
            ->shouldReturn('bar');

        $this
            ->getAttribute('unknownAttribute')
            ->shouldReturn(null);

        $this
            ->getAttribute('unknownAttribute', 'foo')
            ->shouldReturn('foo');
    }

    public function it_can_get_roles()
    {
        $this
            ->getRoles()
            ->shouldReturn(['ROLE_CAS_AUTHENTICATED']);
    }

    public function it_can_get_the_attributes()
    {
        $this
            ->getAttributes()
            ->shouldReturn(['foo' => 'bar']);
    }

    public function it_can_get_the_proxy_granting_ticket()
    {
        $this
            ->getPgt()
            ->shouldReturn('proxyGrantingTicket');
    }

    public function it_does_not_allow_to_get_salt()
    {
        $this
            ->shouldThrow(LogicException::class)
            ->during('getSalt');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CasUser::class);
    }

    public function let()
    {
        $userData = [
            'user' => 'username',
            'attributes' => [
                'foo' => 'bar',
            ],
            'proxyGrantingTicket' => 'proxyGrantingTicket',
        ];

        $this
            ->beConstructedWith($userData);
    }
}
