<?php

declare(strict_types=1);

namespace App\Application\Command\Movie;

use App\Domain\Shared\Bus\Command\Command;

class MovieDeleteCommand extends Command
{
    public $id;
}
