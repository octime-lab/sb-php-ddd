<?php

namespace App\Domain\BoundedContext\Movie;

interface MovieRepository
{
    public function findById(string $id): ?Movie;

    public function list(int $page, int $limit): Movies;

    public function create(Movie $movie): void;

    public function deleteById(string $id): void;
}
