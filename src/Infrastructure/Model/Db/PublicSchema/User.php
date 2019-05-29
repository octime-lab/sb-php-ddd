<?php

namespace App\Infrastructure\Model\Db\PublicSchema;

use PommProject\ModelManager\Model\FlexibleEntity;
use Symfony\Component\Security\Core\User\UserInterface;

class User extends FlexibleEntity implements UserInterface
{
    public function getUsername(): string
    {
        return $this->get('username');
    }

    public function getPassword(): string
    {
        return $this->get('password');
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getSalt(): void
    {
        return;
    }

    public function eraseCredentials(): void
    {
    }
}
