<?php

declare(strict_types=1);

namespace App\Domain\BoundedContext\Movie;

use App\Domain\Shared\AggregateRoot;

final class Movie extends AggregateRoot
{
    private $exploitationVisa;
    private $title;
    private $year;

    public function __construct(MovieId $id, MovieExploitationVisa $exploitationVisa, MovieTitle $title, MovieYear $year)
    {
        parent::__construct($id);

        $this->exploitationVisa = $exploitationVisa;
        $this->title = $title;
        $this->year = $year;
    }

    public function exploitationVisa(): string
    {
        return $this->exploitationVisa->value();
    }

    public function title(): string
    {
        return $this->title->value();
    }

    public function year(): int
    {
        return $this->year->value();
    }
}
