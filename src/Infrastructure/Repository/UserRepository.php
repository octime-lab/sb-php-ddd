<?php

namespace App\Infrastructure\Repository;

use App\Infrastructure\Model\Db\PublicSchema\User;
use App\Infrastructure\Model\Db\PublicSchema\UserModel;

class UserRepository
{
    /**
     * @var UserModel
     */
    private $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function findByUsername(string $username): ?User
    {
        $collection = $this->userModel->findByUsername($username);

        if ($collection->isEmpty()) {
            return null;
        }

        return $collection->current();
    }
}
