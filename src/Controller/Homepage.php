<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

final class Homepage
{
    public function __invoke(): Response
    {
        $body = <<< 'EOF'
<p>You have been redirected here by default. You are most probably using the default CAS configuration.</p>

<p>The default CAS bundle configuration should be installed in <code>config/packages/dev/cas_bundle.yaml</code></p>

<p>Please update your configuration and replace <code>cas_bundle_homepage</code> with an existing route of your app.</p>
EOF;

        return new Response($body);
    }
}
