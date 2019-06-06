<?php

namespace App\Domain\Collection;

use App\Domain\Entity\Movie;

class AddressCollection extends DomainEntityCollection
{
    public function __construct()
    {
        parent::__construct(Movie::class);
    }
}
