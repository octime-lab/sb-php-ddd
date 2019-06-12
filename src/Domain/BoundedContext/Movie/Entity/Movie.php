<?php

namespace App\Domain\BoundedContext\Movie\Entity;

use App\Domain\BoundedContext\Movie\ValueObject\ExploitationVisa;
use App\Domain\Shared\Entity\DomainEntity;

class Movie extends DomainEntity
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $year;

    public function __construct(ExploitationVisa $exploitationVisa, string $title, int $year)
    {
        parent::__construct(new ExploitationVisa($exploitationVisa));

        $this->title = $title;
        $this->year = $year;
    }

    public function getExploitationVisa(): string
    {
        return $this->domainId->getId();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getYear(): int
    {
        return $this->year;
    }
}
