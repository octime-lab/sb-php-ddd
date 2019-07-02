<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\Db\PublicSchema;

use App\Infrastructure\Model\Db\PublicSchema\AutoStructure\User as UserStructure;
use PommProject\ModelManager\Model\CollectionIterator;
use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

class UserModel extends Model
{
    use WriteQueries;

    public function __construct()
    {
        $this->structure = new UserStructure();
        $this->flexible_entity_class = User::class;
    }

    public function findByUsername(string $username): CollectionIterator
    {
        $sql = <<<SQL
            SELECT *
            FROM "user"
            WHERE username = '$username'
SQL;

        return $this->query($sql);
    }
}
