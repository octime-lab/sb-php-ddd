<?php

namespace App\Infrastructure\InMemory;

use App\Domain\BoundedContext\Movie\Collection\MovieCollection;
use App\Domain\BoundedContext\Movie\Entity\Movie;
use App\Domain\BoundedContext\Movie\Repository\MovieRepositoryInterface;
use App\Domain\BoundedContext\Movie\ValueObject\ExploitationVisa;

final class MovieInMemory implements MovieRepositoryInterface
{
    /**
     * @var MovieCollection
     */
    private $movies;

    public function __construct()
    {
        $this->movies = new MovieCollection();
        $this->movies->append(new Movie(new ExploitationVisa('134562'), 'Rambo: last blood', 2019));
        $this->movies->append(new Movie(new ExploitationVisa('135624'), 'Avengers endgame', 2019));
    }

    public function save(Movie $movie): void
    {
        $this->movies->append($movie);
    }

    public function deleteByExploitationVisa(string $exploitationVisa): void
    {
        foreach ($this->movies as $movie) {
            if ($movie->getExploitationVisa === $exploitationVisa) {
                $this->movies->remove($movie);
            }
        }
    }

    public function findByExploitationVisa(string $exploitationVisa): ?Movie
    {
        foreach ($this->movies as $movie) {
            if ($movie->getExploitationVisa === $exploitationVisa) {
                return $movie;
            }
        }

        return null;
    }

    public function list(int $page, $limit): MovieCollection
    {
        return $this->movies;
    }
}
