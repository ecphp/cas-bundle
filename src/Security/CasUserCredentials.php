<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Security;

use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CredentialsInterface;

/**
 * Class CasUserCredentials.
 */
class CasUserCredentials implements CredentialsInterface
{
    public function isResolved(): bool
    {
        return true;
    }
}
