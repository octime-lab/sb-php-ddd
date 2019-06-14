<?php

namespace App\Infrastructure\Command;

interface CommandHandlerInterface
{
    public function handle(Command $command): void;
}
