<?php

namespace App\Domain\BoundedContext\Movie;

use App\Domain\Shared\Collection;

final class Movies extends Collection
{
    public function __construct()
    {
        parent::__construct(Movie::class);
    }
}
