<?php

declare(strict_types=1);

namespace drupol\CasBundle\Security\Core\User;

use drupol\psrcas\Introspection\Contract\ServiceValidate;
use drupol\psrcas\Introspection\Introspector;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;

use function get_class;

class CasUserProvider implements CasUserProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function loadUserByResponse(ResponseInterface $response): CasUserInterface
    {
        try {
            $introspect = Introspector::detect($response);
        } catch (InvalidArgumentException $exception) {
            throw new AuthenticationException($exception->getMessage());
        }

        if ($introspect instanceof ServiceValidate) {
            return new CasUser($introspect->getCredentials());
        }

        throw new AuthenticationException('Unable to load user from response.');
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        throw new UnsupportedUserException(sprintf('Username "%s" does not exist.', $username));
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof CasUserInterface) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return CasUser::class === $class;
    }
}
