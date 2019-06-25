<?php

declare(strict_types=1);

namespace App\Infrastructure\Provider;

use App\Infrastructure\Model\Db\PublicSchema\User;
use App\Infrastructure\Repository\UserRepositoryPomm;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

final class UserProvider implements UserProviderInterface
{
    private $userRepository;

    public function __construct(UserRepositoryPomm $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByUsername($username): ?User
    {
        return $this->userRepository->findByUsername($username);
    }

    public function refreshUser(UserInterface $user): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }
    }

    public function supportsClass($class): bool
    {
        return User::class === $class;
    }
}
