<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace spec\EcPhp\CasBundle\Controller;

use EcPhp\CasBundle\Controller\Login;
use EcPhp\CasLib\CasInterface;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class LoginSpec extends ObjectBehavior
{
    public function it_can_be_invoked(CasInterface $cas, Security $security, ResponseInterface $casResponse)
    {
        $request = Request::create('');
        $response = $this->__invoke($request, $cas, $security);
        $response->shouldBeAnInstanceOf(RedirectResponse::class);
        $response->headers->get('location')->shouldBe('/');

        $casResponse->getHeaderLine('location')->willReturn('https://foo.com');
        $cas->login(['renew' => false])->willReturn($casResponse);

        $response = $this->__invoke($request, $cas, $security);
        $response->shouldBeAnInstanceOf(ResponseInterface::class);
        $response->getHeaderLine('location')->shouldBe('https://foo.com');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Login::class);
    }
}
