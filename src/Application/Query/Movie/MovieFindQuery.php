<?php

declare(strict_types=1);

namespace App\Application\Query\Movie;

use App\Domain\Shared\Bus\Query\Query;

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
