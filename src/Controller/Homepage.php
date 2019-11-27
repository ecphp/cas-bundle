<?php

declare(strict_types=1);

namespace drupol\CasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Homepage.
 */
final class Homepage extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke()
    {
        $configuration = print_r($this->container->get('parameter_bag')->get('cas'), true);

        $body = <<<EOF
<p>You have been redirected here by default. You are most probably using the default CAS configuration.</p>

<p>Here's a dump of the current enabled configuration:</p>
<textarea>$configuration</textarea>

<p>The default CAS bundle configuration is installed in <code>config/packages/dev/cas_bundle.yaml</code></p>

<p>Please update your configuration and replace <code>cas_bundle_homepage</code> with an existing route of your app.</p>
EOF;

        return new Response($body);
    }
}
