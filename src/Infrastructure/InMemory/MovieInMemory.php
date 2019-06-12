<?php

namespace App\Infrastructure\InMemory;

use App\Domain\BoundedContext\Movie\Collection\MovieCollection;
use App\Domain\BoundedContext\Movie\Entity\Movie;
use App\Domain\BoundedContext\Movie\Repository\MovieRepositoryInterface;
use App\Domain\BoundedContext\Movie\ValueObject\ExploitationVisa;

final class MovieInMemory implements MovieRepositoryInterface
{
    public function save(Movie $movie): void
    {
        // TODO: Implement save() method.
    }

    public function findByExploitationVisa(string $exploitationVisa): Movie
    {
        return new Movie(new ExploitationVisa('134562'), 'Rambo: last blood', 2019);
    }

    public function findAll(int $page, $limit): MovieCollection
    {
        $movieCollection = new MovieCollection();
        $movieCollection->append(new Movie(new ExploitationVisa('134562'), 'Rambo: last blood', 2019));
        $movieCollection->append(new Movie(new ExploitationVisa('135624'), 'Avengers endgame', 2019));

        return $movieCollection;
    }
}
