<?php

declare(strict_types=1);

namespace App\Application\Query\Movie;

use App\Domain\Shared\Bus\Query\Query;

class MovieListQuery implements Query
{
    public $page;
    public $limit;

    public function __construct(int $page = 1, int $limit = 10)
    {
        $this->page = $page;
        $this->limit = $limit;
    }
}
