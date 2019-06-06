<?php

namespace App\Infrastructure\Model\Db\PublicSchema;

use App\Infrastructure\Model\Db\PublicSchema\AutoStructure\Movie as MovieStructure;
use PommProject\ModelManager\Model\CollectionIterator;
use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

class MovieModel extends Model
{
    use WriteQueries;

    public function __construct()
    {
        $this->structure = new MovieStructure();
        $this->flexible_entity_class = Movie::class;
    }

    public function findByExploitationVisa(string $exploitationVisa): CollectionIterator
    {
        $sql = <<<SQL
            SELECT *
            FROM movie
            WHERE exploitation_visa = '$exploitationVisa'
SQL;

        return $this->query($sql);
    }
}
