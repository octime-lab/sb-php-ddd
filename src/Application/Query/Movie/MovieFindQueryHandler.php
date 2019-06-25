<?php

declare(strict_types=1);

namespace App\Application\Query\Movie;

use App\Application\Query\Item;
use App\Domain\BoundedContext\Movie\MovieFinder;
use App\Domain\BoundedContext\Movie\MovieId;
use App\Domain\BoundedContext\Movie\MovieRepository;
use App\Domain\Shared\Bus\Query\Query;
use App\Domain\Shared\Bus\Query\QueryHandler;
use App\Domain\Shared\Bus\Query\Response;
use App\Infrastructure\View\MovieView;

final class MovieFindQueryHandler implements QueryHandler
{
    private $repository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->repository = $movieRepository;
    }

    public function handle(Query $query): Response
    {
        $movieData = (new MovieFinder($this->repository))(new MovieId($query->id()));
        $movieView = MovieView::deserialize($movieData);

        return new Item($movieView);
    }
}
