<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace spec\EcPhp\CasBundle\Controller;

use EcPhp\CasBundle\Controller\Logout;
use EcPhp\CasLib\Contract\CasInterface;
use Exception;
use Nyholm\Psr7\ServerRequest;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LogoutSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Logout::class);
    }

    public function it_redirects_to_index(
        CasInterface $cas,
        Security $security,
        TokenStorageInterface $tokenStorage
    ) {
        $request = new ServerRequest('GET', '/');

        $response = $this->__invoke($request, $cas, $security, $tokenStorage);
        $response->shouldBeAnInstanceOf(RedirectResponse::class);
        $response->headers->get('location')->shouldReturn('/');
    }

    public function it_return_a_psr_response_in_case_of_success(
        CasInterface $cas,
        Security $security,
        TokenStorageInterface $tokenStorage,
        ResponseInterface $casResponse,
    ) {
        $request = new ServerRequest('GET', '/');

        $cas
            ->logout($request)
            ->willReturn($casResponse);

        $casResponse
            ->getHeaderLine('location')
            ->willReturn('http://local/cas/logout');

        $response = $this->__invoke($request, $cas, $security, $tokenStorage);
        $response->shouldBeAnInstanceOf(ResponseInterface::class);
        $response->getHeaderLine('location')->shouldBe('http://local/cas/logout');
        $tokenStorage
            ->setToken(null)
            ->shouldBeCalled();
    }

    public function it_return_a_symfony_redirection_in_case_of_exception(
        CasInterface $cas,
        Security $security,
        TokenStorageInterface $tokenStorage
    ) {
        $request = new ServerRequest('GET', '/');

        $cas
            ->logout($request)
            ->willThrow(new Exception('Unable to login'));

        $response = $this->__invoke($request, $cas, $security, $tokenStorage);
        $response->shouldBeAnInstanceOf(RedirectResponse::class);
        $response->headers->get('location')->shouldBe('/');
    }
}
