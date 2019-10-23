<?php

declare(strict_types=1);

namespace drupol\CasBundle\Controller\CasBundle;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class Homepage.
 */
final class Homepage
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke()
    {
        $body = <<< 'EOF'
<p>You have been redirected here by default.</p>

<p>Please update your configuration and replace <code>cas_bundle_homepage</code> with an existing route of your app.</p>
EOF;

        return new Response($body);
    }
}
