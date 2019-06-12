<?php

namespace App\Application\Command\Movie;

use App\Application\Command\Command;
use App\Domain\BoundedContext\Movie\Repository\MovieRepositoryInterface;
use App\Domain\BoundedContext\Movie\Service\CreateAMovie;
use App\Application\Command\CommandHandlerInterface;

final class MovieCreateCommandHandler implements CommandHandlerInterface
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
        $this->movieRepository->save(CreateAMovie::handle($command->exploitationVisa, $command->title, $command->year));
    }
}
