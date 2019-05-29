<?php

namespace App\Infrastructure\Command\Command;

interface CommandHandlerInterface
{
    public function handle(Command $command): void;
}
