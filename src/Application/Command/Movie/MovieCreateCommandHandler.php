<?php

namespace App\Application\Command\Movie;

use App\Domain\BoundedContext\Movie\MovieCreate;
use App\Domain\BoundedContext\Movie\MovieRepository;
use App\Infrastucture\Command\Command;
use App\Infrastucture\Command\CommandHandlerInterface;

final class MovieCreateCommandHandler implements CommandHandlerInterface
{
    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function handle(Command $command): void
    {
        $this->movieRepository->save(MovieCreate::handle($command->exploitationVisa, $command->title, $command->year));
    }
}
