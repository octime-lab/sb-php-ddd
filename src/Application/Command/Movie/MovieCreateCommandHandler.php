<?php

namespace App\Application\Command\Movie;

use App\Domain\BoundedContext\Movie\MovieCreate;
use App\Domain\BoundedContext\Movie\MovieRepository;
use App\Domain\Shared\Bus\Command\Command;
use App\Domain\Shared\Bus\Command\CommandHandler;

final class MovieCreateCommandHandler implements CommandHandler
{
    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function handle(Command $command): void
    {
        $this->movieRepository->create(MovieCreate::handle($command->exploitationVisa, $command->title, $command->year));
    }
}
