<?php

namespace App\Application\Command\Movie;

use App\Domain\BoundedContext\Movie\MovieRepository;
use App\Infrastucture\Command\Command;
use App\Infrastucture\Command\CommandHandlerInterface;

final class MovieDeleteCommandHandler implements CommandHandlerInterface
{
    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function handle(Command $command): void
    {
        $this->movieRepository->deleteById($command->exploitationVisa);
    }
}
