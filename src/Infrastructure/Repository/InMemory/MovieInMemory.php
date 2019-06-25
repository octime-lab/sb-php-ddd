<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\InMemory;

use App\Domain\BoundedContext\Movie\Movie;
use App\Domain\BoundedContext\Movie\MovieId;
use App\Domain\BoundedContext\Movie\MovieRepository;

final class MovieInMemory implements MovieRepository
{
    public function delete(MovieId $id): void
    {
        // TODO: Implement deleteById() method.
    }

    public function create(Movie $movie): void
    {
        // TODO: Implement create() method.
    }

    public function search(MovieId $id): array
    {
        // TODO: Implement findById() method.
    }

    public function list(int $page, int $limit): array
    {
        // TODO: Implement list() method.
    }
}
