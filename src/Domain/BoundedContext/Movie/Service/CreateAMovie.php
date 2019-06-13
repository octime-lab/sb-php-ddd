<?php

namespace App\Domain\BoundedContext\Movie\Service;

use App\Domain\BoundedContext\Movie\Entity\Movie;
use App\Domain\BoundedContext\Movie\ValueObject\ExploitationVisa;

class CreateAMovie
{
    public static function handle(string $exploitationVisa, string $title, int $year): Movie
    {
        return new Movie(new ExploitationVisa($exploitationVisa), $title, $year);
    }
}
