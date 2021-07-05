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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

final class Login
{
    public function __invoke(
        Request $request,
        CasInterface $cas,
        Security $security
    ): RedirectResponse {
        $parameters = $request->query->all() + [
            'renew' => null !== $security->getUser(),
        ];

        if (null !== $response = $cas->login($parameters)) {
            return new RedirectResponse($response->getHeaderLine('location'));
        }

        return new RedirectResponse('/');
    }
}
