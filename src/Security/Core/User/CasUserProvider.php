<?php

declare(strict_types=1);

namespace EcPhp\CasBundle\Security\Core\User;

use EcPhp\CasLib\Introspection\Contract\IntrospectorInterface;
use EcPhp\CasLib\Introspection\Contract\ServiceValidate;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;

use function get_class;

class CasUserProvider implements CasUserProviderInterface
{
    /**
     * @var IntrospectorInterface
     */
    private $introspector;

    public function __construct(IntrospectorInterface $introspector)
    {
        $this->introspector = $introspector;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByResponse(ResponseInterface $response): CasUserInterface
    {
        try {
            $introspect = $this->introspector->detect($response);
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
    public function loadUserByUsername(string $username): UserInterface
    {
        throw new UnsupportedUserException(sprintf('Username "%s" does not exist.', $username));
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof CasUserInterface) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass(string $class): bool
    {
        return CasUser::class === $class;
    }
}
