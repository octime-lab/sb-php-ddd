<?php

namespace App\Domain\BoundedContext\Movie\Collection;

use App\Domain\BoundedContext\Entity\Movie;
use App\Domain\Shared\Collection\DomainEntityCollection;

class MovieCollection extends DomainEntityCollection
{
    public function __construct()
    {
        parent::__construct(Movie::class);
    }
}
