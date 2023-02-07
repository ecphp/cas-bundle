<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Controller;

use EcPhp\CasBundle\Cas\SymfonyCasInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Throwable;

/**
 * @deprecated Use a security entry point, see https://symfony.com/doc/current/security/entry_point.html
 */
final class Login
{
    public function __invoke(
        Request $request,
        SymfonyCasInterface $cas,
        Security $security
    ): RedirectResponse|ResponseInterface {
        $parameters = $request->query->all() + [
            'renew' => null !== $security->getUser(),
        ];

        try {
            $response = $cas
                ->login(
                    $request,
                    $parameters
                );
        } catch (Throwable) {
            // TODO: Should we log the error ?
            // If yes, we need to inject the LoggerInterface and require it
            // in composer.json. Do we want an extra dependency?
            return new RedirectResponse('/');
        }

        return $response;
    }
}
