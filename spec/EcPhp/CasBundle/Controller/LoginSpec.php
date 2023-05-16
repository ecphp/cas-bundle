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
use EcPhp\CasLib\Contract\CasInterface;
use Exception;
use Nyholm\Psr7\ServerRequest;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Login::class);
    }

    public function it_return_a_psr_response_in_case_of_success(
        CasInterface $cas,
        Security $security,
        ResponseInterface $casResponse,
    ) {
        $request = new ServerRequest('GET', '/');

        $cas
            ->login($request)
            ->willReturn($casResponse);

        $casResponse
            ->getHeaderLine('location')
            ->willReturn('https://foo.com');

        $response = $this->__invoke($request, $cas, $security);
        $response->shouldBeAnInstanceOf(ResponseInterface::class);
        $response->getHeaderLine('location')->shouldBe('https://foo.com');
    }

    public function it_return_a_symfony_redirection_in_case_of_exception(
        CasInterface $cas,
        Security $security,
    ) {
        $request = new ServerRequest('GET', '/');

        $cas
            ->login($request)
            ->willThrow(new Exception('Unable to login'));

        $response = $this->__invoke($request, $cas, $security);
        $response->shouldBeAnInstanceOf(RedirectResponse::class);
        $response->headers->get('location')->shouldBe('/');
    }
}
