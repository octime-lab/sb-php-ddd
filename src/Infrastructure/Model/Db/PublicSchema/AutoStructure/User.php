<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\Db\PublicSchema\AutoStructure;

use PommProject\ModelManager\Model\RowStructure;

class User extends RowStructure
{
    public function __construct()
    {
        $this
            ->setRelation('public.user')
            ->setPrimaryKey(['id'])
            ->addField('id', 'int4')
            ->addField('username', 'varchar')
            ->addField('password', 'varchar')
            ->addField('email', 'varchar')
            ->addField('is_active', 'bool')
            ;
    }
}
