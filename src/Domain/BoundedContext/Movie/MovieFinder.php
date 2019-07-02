<?php

declare(strict_types=1);

namespace App\Domain\BoundedContext\Movie;

final class MovieFinder
{
    private $repository;

    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(MovieId $id): array
    {
        $movie = $this->repository->search($id);

        $this->ensureMovieExists($id, $movie);

        return $movie;
    }

    private function ensureMovieExists(MovieId $id, array $movie = []): void
    {
        if ([] === $movie) {
            throw new MovieNotFound($id);
        }
    }
}
