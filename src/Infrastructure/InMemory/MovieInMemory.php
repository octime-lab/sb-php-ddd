<?php

namespace App\Infrastructure\InMemory;

use App\Domain\BoundedContext\Movie\Movie;
use App\Domain\BoundedContext\Movie\MovieRepository;
use App\Domain\BoundedContext\Movie\Movies;

final class MovieInMemory implements MovieRepository
{
    public function deleteById(string $id): void
    {
        // TODO: Implement deleteById() method.
    }

    public function create(Movie $movie): void
    {
        // TODO: Implement create() method.
    }

    public function findById(string $id): ?Movie
    {
        // TODO: Implement findById() method.
    }

    public function list(int $page, int $limit): Movies
    {
        // TODO: Implement list() method.
    }
}
