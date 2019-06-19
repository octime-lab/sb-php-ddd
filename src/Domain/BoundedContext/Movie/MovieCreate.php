<?php

namespace App\Domain\BoundedContext\Movie;

use App\Domain\Shared\ValueObject\Uuid;

class MovieCreate
{
    public static function handle(string $exploitationVisa, string $title, int $year): Movie
    {
        return new Movie(new MovieId(Uuid::random()), new MovieExploitationVisa($exploitationVisa), new MovieTitle($title), new MovieYear($year));
    }
}
