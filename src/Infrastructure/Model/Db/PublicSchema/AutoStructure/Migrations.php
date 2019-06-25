<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\Db\PublicSchema\AutoStructure;

use PommProject\ModelManager\Model\RowStructure;

class Migrations extends RowStructure
{
    public function __construct()
    {
        $this
            ->setRelation('public.migrations')
            ->setPrimaryKey(['version'])
            ->addField('version', 'int8')
            ->addField('migration_name', 'varchar')
            ->addField('start_time', 'timestamp')
            ->addField('end_time', 'timestamp')
            ->addField('breakpoint', 'bool')
            ;
    }
}
