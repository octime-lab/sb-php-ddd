<?php

namespace App\Domain\BoundedContext\Movie;

use App\Domain\Shared\Entity\DomainEntity;

class Movie extends DomainEntity
{
    private $title;

    private $year;

    public function __construct(MovieExploitationVisa $exploitationVisa, MovieTitle $title, MovieYear $year)
    {
        parent::__construct($exploitationVisa);

        $this->title = $title;
        $this->year = $year;
    }

    public function exploitationVisa(): string
    {
        return $this->domainId->id();
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
