<?php

namespace App\Application\Command;

interface CommandHandlerInterface
{
    public function handle(Command $command): void;
}
