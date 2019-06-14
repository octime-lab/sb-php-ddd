<?php

namespace App\Infrastructure\InMemory;

use App\Domain\BoundedContext\Movie\Movie;
use App\Domain\BoundedContext\Movie\MovieRepository;
use App\Domain\BoundedContext\Movie\Movies;

final class MovieInMemory implements MovieRepository
{
    public function findByExploitationVisa(string $exploitationVisa): ?Movie
    {
        // TODO: Implement findByExploitationVisa() method.
    }

    public function create(Movie $movie): void
    {
        // TODO: Implement create() method.
    }

    public function deleteByExploitationVisa(string $exploitationVisa): void
    {
        // TODO: Implement deleteByExploitationVisa() method.
    }

    public function list(int $page, int $limit): Movies
    {
        // TODO: Implement list() method.
    }
}
