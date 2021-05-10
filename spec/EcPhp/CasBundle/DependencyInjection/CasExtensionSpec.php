<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\EcPhp\CasBundle\DependencyInjection;

use EcPhp\CasBundle\DependencyInjection\CasExtension;
use PhpSpec\ObjectBehavior;

class CasExtensionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(CasExtension::class);
    }
}
