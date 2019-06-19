<?php

namespace App\Domain\BoundedContext\Movie;

interface MovieRepository
{
    public function search(MovieId $id): ?Movie;

    public function list(int $page, int $limit): Movies;

    public function create(Movie $movie): void;

    public function delete(MovieId $id): void;
}
