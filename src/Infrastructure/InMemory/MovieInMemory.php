<?php

namespace App\Infrastructure\InMemory;

use App\Domain\Entity\Movie;
use App\Domain\Repository\MovieRepositoryInterface;
use App\Domain\ValueObject\Movie\ExploitationVisa;

final class MovieInMemory implements MovieRepositoryInterface
{
    public function findByExploitationVisa(string $exploitationVisa): Movie
    {
        return new Movie(new ExploitationVisa('134562'), 'Rambo: last blood', 2019);
    }
}
