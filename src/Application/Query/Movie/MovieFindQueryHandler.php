<?php

namespace App\Application\Query\Movie;

use App\Domain\BoundedContext\Movie\MovieFinder;
use App\Domain\BoundedContext\Movie\MovieId;
use App\Infrastructure\Command\QueryHandler;
use App\Infrastructure\View\MovieView;

final class MovieFindQueryHandler implements QueryHandler
{
    private $finder;

    public function __construct(MovieFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(FindMovieQuery $query): MovieView
    {
        $id = new MovieId($query->id());

        // ....
    }
}
