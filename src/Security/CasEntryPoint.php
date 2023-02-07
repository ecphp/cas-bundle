<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Security;

use EcPhp\CasBundle\Cas\SymfonyCasInterface;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Throwable;

final class CasEntryPoint implements AuthenticationEntryPointInterface
{
    public function __construct(private readonly SymfonyCasInterface $cas, private readonly Security $security, private readonly HttpFoundationFactoryInterface $httpFoundationFactory)
    {
    }

    public function start(Request $request, ?AuthenticationException $authException = null): Response
    {
        $parameters = $request->query->all() + [
            'renew' => null !== $this->security->getUser(),
        ];

        try {
            $response = $this
                ->cas
                ->login(
                    $request,
                    $parameters
                );
        } catch (Throwable $e) {
            throw new AuthenticationException('Unable to start the CAS authentication process', 0, $e);
        }

        return $this->httpFoundationFactory->createResponse($response);
    }
}
