<?php

declare(strict_types=1);

namespace App\Application\Command\Movie;

use App\Domain\BoundedContext\Movie\MovieId;
use App\Domain\BoundedContext\Movie\MovieRepository;
use App\Domain\Shared\Bus\Command\Command;
use App\Domain\Shared\Bus\Command\CommandHandler;

final class MovieDeleteCommandHandler implements CommandHandler
{
    private $repository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->repository = $movieRepository;
    }

    public function handle(Command $command): void
    {
        $this->repository->delete(new MovieId($command->id));
    }
}
