<?php

namespace App\Application\Command\Movie;

use App\Application\Command\Command;
use App\Domain\BoundedContext\Movie\Repository\MovieRepositoryInterface;
use App\Application\Command\CommandHandlerInterface;

final class MovieDeleteCommandHandler implements CommandHandlerInterface
{
    /**
     * @var MovieRepositoryInterface
     */
    private $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function handle(Command $command): void
    {
        $this->movieRepository->deleteById($command->exploitationVisa);
    }
}
