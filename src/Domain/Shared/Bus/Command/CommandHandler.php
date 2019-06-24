<?php

namespace App\Domain\Shared\Bus\Command;

interface CommandHandler
{
    public function handle(Command $command): void;
}
