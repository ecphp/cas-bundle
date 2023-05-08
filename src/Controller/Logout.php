<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Controller;

use EcPhp\CasLib\Contract\CasInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Throwable;

final class Logout
{
    public function __invoke(
        ServerRequestInterface $request,
        CasInterface $cas,
        Security $security,
        TokenStorageInterface $tokenStorage
    ): ResponseInterface|RedirectResponse {
        try {
            $response = $cas->logout($request);
        } catch (Throwable) {
            // TODO: Should we log the error ?
            // If yes, we need to inject the LoggerInterface and require it
            // in composer.json. Do we want an extra dependency?
            return new RedirectResponse('/');
        }

        $security->getToken()?->eraseCredentials();
        $tokenStorage->setToken(null);

        return $response;
    }
}
