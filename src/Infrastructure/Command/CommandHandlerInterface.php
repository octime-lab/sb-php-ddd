<?php

namespace App\Infrastructure\Command;

use App\Domain\Command\Command;

interface CommandHandlerInterface
{
    public function handle(Command $command): void;
}
