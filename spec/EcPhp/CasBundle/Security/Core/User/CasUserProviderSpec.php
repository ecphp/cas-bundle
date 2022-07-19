<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace spec\EcPhp\CasBundle\Security\Core\User;

use EcPhp\CasBundle\Security\Core\User\CasUser;
use EcPhp\CasBundle\Security\Core\User\CasUserInterface;
use EcPhp\CasBundle\Security\Core\User\CasUserProvider;
use EcPhp\CasLib\Introspection\Introspector;
use Nyholm\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\InMemoryUser;
use Symfony\Component\Security\Core\User\User;

class CasUserProviderSpec extends ObjectBehavior
{
    public function it_can_check_if_it_is_possible_to_load_a_user_by_username()
    {
        $this
            ->shouldThrow(UnsupportedUserException::class)
            ->during('loadUserByUsername', ['foo']);
    }

    public function it_can_check_if_the_user_class_is_supported()
    {
        $this
            ->supportsClass(CasUser::class)
            ->shouldReturn(true);

        $this
            ->supportsClass(User::class)
            ->shouldReturn(false);
    }

    public function it_can_load_a_user_with_a_response()
    {
        $body = <<< 'EOF'
            <cas:serviceResponse xmlns:cas="http://www.yale.edu/tp/cas">
             <cas:authenticationSuccess>
              <cas:user>username</cas:user>
             </cas:authenticationSuccess>
            </cas:serviceResponse>
            EOF;

        $response = new Response(200, ['content-type' => 'application/xml'], $body);

        $this
            ->loadUserByResponse($response)
            ->shouldBeAnInstanceOf(CasUserInterface::class);

        $body = <<< 'EOF'
            <cas:serviceResponse xmlns:cas="http://www.yale.edu/tp/cas">
             <cas:authenticationFailure>
             </cas:authenticationFailure>
            </cas:serviceResponse>
            EOF;

        $response = new Response(200, ['content-type' => 'application/xml'], $body);

        $this
            ->shouldThrow(AuthenticationException::class)
            ->during('loadUserByResponse', [$response]);
    }

    public function it_can_refresh_the_user()
    {
        $user = new CasUser([]);

        $this
            ->refreshUser($user)
            ->shouldReturn($user);

        $user = new InMemoryUser('username', 'password');

        $this
            ->shouldThrow(UnsupportedUserException::class)
            ->during('refreshUser', [$user]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CasUserProvider::class);
    }

    public function let()
    {
        $this
            ->beConstructedWith(new Introspector());
    }
}
