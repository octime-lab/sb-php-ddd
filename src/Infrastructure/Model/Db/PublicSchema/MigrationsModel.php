<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\Db\PublicSchema;

use App\Infrastructure\Model\Db\PublicSchema\AutoStructure\Migrations as MigrationsStructure;
use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

class MigrationsModel extends Model
{
    use WriteQueries;

    public function __construct()
    {
        $this->structure = new MigrationsStructure();
        $this->flexible_entity_class = Migrations::class;
    }
}
