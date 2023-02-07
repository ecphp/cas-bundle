<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace spec\EcPhp\CasBundle\Controller;

use EcPhp\CasBundle\Cas\SymfonyCasInterface;
use EcPhp\CasBundle\Controller\Logout;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LogoutSpec extends ObjectBehavior
{
    public function it_can_be_invoked(
        SymfonyCasInterface $cas,
        ResponseInterface $casResponse,
        Security $security,
        TokenStorageInterface $tokenStorage,
    ) {
        $request = Request::create('');

        $casResponse
            ->getHeaderLine('location')
            ->willReturn('http://local/cas/logout');

        $cas
            ->logout(
                $request,
                []
            )
            ->willReturn($casResponse);

        $response = $this->__invoke($request, $cas, $security, $tokenStorage);

        $response
            ->shouldBeAnInstanceOf(ResponseInterface::class);

        $response
            ->getHeaderLine('location')
            ->shouldReturn('http://local/cas/logout');

        $tokenStorage
            ->setToken(null)
            ->shouldBeCalled();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Logout::class);
    }

    public function it_redirects_to_index(
        SymfonyCasInterface $cas,
        Security $security,
        TokenStorageInterface $tokenStorage
    ) {
        $request = Request::create('');

        $response = $this->__invoke($request, $cas, $security, $tokenStorage);
        $response->shouldBeAnInstanceOf(RedirectResponse::class);
        $response->headers->get('location')->shouldReturn('/');
    }
}
