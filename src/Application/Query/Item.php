<?php

declare(strict_types=1);

namespace App\Application\Query;

use App\Domain\Shared\Bus\Query\Response;
use App\Infrastructure\Shared\ReadModel\SerializableReadModel;

final class Item implements Response
{
    public $id;
    public $type;
    public $resource;
    public $relationships = [];
    public $readModel;

    public function __construct(SerializableReadModel $serializableReadModel, array $relations = [])
    {
        $this->id = $serializableReadModel->getId();
        $this->type = $this->type($serializableReadModel);
        $this->resource = $serializableReadModel->serialize();
        $this->relationships = $relations;
        $this->readModel = $serializableReadModel;
    }

    private function type(SerializableReadModel $model): string
    {
        $path = explode('\\', \get_class($model));

        return array_pop($path);
    }
}
