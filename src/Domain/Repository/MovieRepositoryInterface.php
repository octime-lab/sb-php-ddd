<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Movie;

interface MovieRepositoryInterface
{
    public function findByExploitationVisa(string $exploitationVisa): Movie;
}
