<?php

namespace App\Domain\BoundedContext\Movie\Service;

use App\Domain\BoundedContext\Movie\Entity\Movie;

class CreateAMovie
{
    public static function handle(string $exploitationVisa, string $title, int $year): Movie
    {
        return new Movie($exploitationVisa, $title, $year);
    }
}
