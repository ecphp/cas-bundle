<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Security\Core\User;

use EcPhp\CasLib\Contract\Response\CasResponseBuilderInterface;
use EcPhp\CasLib\Contract\Response\Type\ServiceValidate;
use Exception;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Throwable;

use function sprintf;

final class CasUserProvider implements CasUserProviderInterface
{
    public function __construct(
        private readonly CasResponseBuilderInterface $casResponseBuilder,
        private readonly HttpMessageFactoryInterface $httpMessageFactory
    ) {}

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        throw new UnsupportedUserException('Unsupported operation.');
    }

    public function loadUserByResponse(Response $response): CasUserInterface
    {
        try {
            $casResponse = $this
                ->casResponseBuilder
                ->fromResponse($this->httpMessageFactory->createResponse($response));
        } catch (Throwable $e) {
            throw new UserNotFoundException(
                sprintf('Unable to get user from response, %s', $e->getMessage()),
                0,
                $e
            );
        }

        if (!$casResponse instanceof ServiceValidate) {
            throw new UserNotFoundException(
                'Unable to get user from response'
            );
        }

        try {
            $credentials = $casResponse->toArray();
        } catch (Throwable $e) {
            throw new Exception(
                sprintf('Unable to convert the response, %s', $e->getMessage()),
                0,
                $e
            );
        }

        return new CasUser($credentials['serviceResponse']['authenticationSuccess']);
    }

    public function loadUserByUsername(string $username): never
    {
        throw new UnsupportedUserException(sprintf('Username "%s" does not exist.', $username));
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof CasUserInterface) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return CasUser::class === $class;
    }
}
