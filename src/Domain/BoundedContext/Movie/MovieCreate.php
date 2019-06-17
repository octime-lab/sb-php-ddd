<?php

namespace App\Domain\BoundedContext\Movie;

class MovieCreate
{
    public static function handle(string $exploitationVisa, string $title, int $year): Movie
    {
        return new Movie(new MovieExploitationVisa($exploitationVisa), new MovieTitle($title), new MovieYear($year));
    }
}