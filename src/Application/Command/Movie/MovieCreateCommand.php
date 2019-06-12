<?php

namespace App\Application\Command\Movie;

use App\Application\Command\Command;

class MovieCreateCommand extends Command
{
    /**
     * @var string
     */
    public $exploitationVisa;

    /**
     * @var string
     */
    public $title;

    /**
     * @var int
     */
    public $year;
}
