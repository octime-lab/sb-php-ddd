<?php

namespace App\Infrastructure\Model\Db\PublicSchema;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;
use App\Infrastructure\Model\Db\PublicSchema\AutoStructure\Migrations as MigrationsStructure;

/**
 * MigrationsModel.
 *
 * Model class for table migrations.
 *
 * @see Model
 */
class MigrationsModel extends Model
{
    use WriteQueries;

    /**
     * __construct().
     *
     * Model constructor
     */
    public function __construct()
    {
        $this->structure = new MigrationsStructure();
        $this->flexible_entity_class = '\App\Infrastructure\Model\Db\PublicSchema\Migrations';
    }
}
