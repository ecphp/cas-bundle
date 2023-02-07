<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Controller;

use EcPhp\CasLib\CasInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class Logout
{
    /**
     * @return RedirectResponse|ResponseInterface
     */
    public function __invoke(
        Request $request,
        CasInterface $cas,
        TokenStorageInterface $tokenStorage
    ) {
        $response = $cas->logout($request->query->all());

        if (null === $response) {
            return new RedirectResponse('/');
        }

        $tokenStorage->setToken(null);

        return $response;
    }
}
