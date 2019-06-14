<?php

namespace App\Domain\BoundedContext\Movie;

use App\Domain\Shared\Collection\DomainEntityCollection;

class Movies extends DomainEntityCollection
{
    public function __construct()
    {
        parent::__construct(Movie::class);
    }
}
