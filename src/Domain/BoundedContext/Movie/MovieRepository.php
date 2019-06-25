<?php

declare(strict_types=1);

namespace App\Domain\BoundedContext\Movie;

interface MovieRepository
{
    public function search(MovieId $id): array;

    public function list(int $page, int $limit): array;

    public function create(Movie $movie): void;

    public function delete(MovieId $id): void;
}
