<?php

namespace App\Infrastructure\Model\Db\PublicSchema\AutoStructure;

use PommProject\ModelManager\Model\RowStructure;

class Movie extends RowStructure
{
    public function __construct()
    {
        $this
            ->setRelation('public.movie')
            ->setPrimaryKey(['id'])
            ->addField('id', 'int4')
            ->addField('exploitation_visa', 'varchar')
            ->addField('title', 'varchar')
            ->addField('year', 'int4')
            ;
    }
}
