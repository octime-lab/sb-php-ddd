<?php

namespace App\Domain\BoundedContext\Movie;

final class MovieFinder
{
    private $repository;

    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(MovieId $id): Movie
    {
        $movie = $this->repository->search($id);

        $this->ensureMovieExists($id, $movie);

        return $movie;
    }

    private function ensureMovieExists(MovieId $id, Movie $movie = null): void
    {
        if (null === $movie) {
            throw new MovieNotFound($id);
        }
    }
}
