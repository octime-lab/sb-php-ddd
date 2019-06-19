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

    public function findById(string $id): CollectionIterator
    {
        $sql = <<<SQL
            SELECT *
            FROM movie
            WHERE id = '$id'
SQL;

        return $this->query($sql);
    }

    public function list(int $page, int $limit): CollectionIterator
    {
        $sql = <<<SQL
            SELECT *
            FROM movie
            LIMIT $limit OFFSET ($page - 1) * $limit
SQL;

        return $this->query($sql);
    }
}
