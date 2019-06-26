<?php

declare(strict_types=1);

namespace App\Application\Query\Movie;

use App\Application\Query\Collection;
use App\Domain\BoundedContext\Movie\MovieRepository;
use App\Domain\Shared\Bus\Query\Query;
use App\Domain\Shared\Bus\Query\QueryHandler;
use App\Domain\Shared\Bus\Query\Response;

class MovieListQueryHandler implements QueryHandler
{
    private $repository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->repository = $movieRepository;
    }

    public function handle(Query $query): Response
    {
        $page = $query->page;
        $limit = $query->limit;
        $data = $this->repository->list($query->page, $query->limit);
        $total = count($data);

        return new Collection($page, $limit, $total, $data);
    }
}
