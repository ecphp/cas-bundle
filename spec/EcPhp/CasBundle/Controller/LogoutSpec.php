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
use EcPhp\CasLib\Cas;
use EcPhp\CasLib\CasInterface;
use EcPhp\CasLib\Introspection\Introspector;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\ServerRequest;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\HttpClient\Psr18Client;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LogoutSpec extends ObjectBehavior
{
    public function it_can_be_invoked(TokenStorageInterface $tokenStorage)
    {
        $serverRequest = new ServerRequest('GET', 'http://app');
        $properties = \spec\EcPhp\CasBundle\Cas::getTestProperties();
        $client = new Psr18Client(\spec\EcPhp\CasBundle\Cas::getHttpClientMock());
        $cache = new ArrayAdapter();
        $logger = new NullLogger();
        $introspector = new Introspector();

        $psr17Factory = new Psr17Factory();

        $cas = new Cas(
            $serverRequest,
            $properties,
            $client,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $cache,
            $logger,
            $introspector
        );

        $request = Request::create('');

        $this
            ->__invoke($request, $cas, $tokenStorage)
            ->shouldBeAnInstanceOf(ResponseInterface::class);

        $this
            ->__invoke($request, $cas, $tokenStorage)
            ->getHeaderLine('location')
            ->shouldReturn('http://local/cas/logout');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Logout::class);
    }

    public function it_redirects_to_index(CasInterface $cas, TokenStorageInterface $tokenStorage)
    {
        $request = Request::create('');

        $response = $this->__invoke($request, $cas, $tokenStorage);
        $response->shouldBeAnInstanceOf(RedirectResponse::class);
        $response->headers->get('location')->shouldReturn('/');
    }
}
