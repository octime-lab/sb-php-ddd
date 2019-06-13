<?php

namespace App\Domain\BoundedContext\Movie\Repository;

use App\Domain\BoundedContext\Movie\Collection\MovieCollection;
use App\Domain\BoundedContext\Movie\Entity\Movie;

interface MovieRepositoryInterface
{
    public function findByExploitationVisa(string $exploitationVisa): ?Movie;

    public function list(int $page, int $limit): MovieCollection;

    public function save(Movie $movie): void;

    public function deleteByExploitationVisa(string $exploitationVisa): void;
}
