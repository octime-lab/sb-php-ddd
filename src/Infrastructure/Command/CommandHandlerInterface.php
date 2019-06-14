<?php

namespace App\Infrastucture\Command;

interface CommandHandlerInterface
{
    public function handle(Command $command): void;
}
