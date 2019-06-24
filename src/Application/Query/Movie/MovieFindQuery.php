<?php

namespace App\Application\Query\Movie;

use App\Infrastructure\Command\Query;

final class MovieFindQuery implements Query
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
