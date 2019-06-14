<?php

namespace App\Domain\BoundedContext\Movie;

interface MovieRepository
{
    public function findByExploitationVisa(string $exploitationVisa): ?Movie;

    public function list(int $page, int $limit): Movies;

    public function create(Movie $movie): void;

    public function deleteByExploitationVisa(string $exploitationVisa): void;
}
