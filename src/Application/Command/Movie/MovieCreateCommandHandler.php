<?php

declare(strict_types=1);

namespace App\Application\Command\Movie;

use App\Domain\BoundedContext\Movie\MovieCreate;
use App\Domain\BoundedContext\Movie\MovieRepository;
use App\Domain\Shared\Bus\Command\Command;
use App\Domain\Shared\Bus\Command\CommandHandler;
use App\Infrastructure\Shared\Bus\Command\CommandType;
use App\Infrastructure\Shared\Exception\NotValidFormException;
use App\Infrastructure\Shared\Utils\Utils;
use Symfony\Component\Form\FormFactory;

final class MovieCreateCommandHandler implements CommandHandler
{
    private $repository;
    private $formFactory;

    public function __construct(MovieRepository $movieRepository, FormFactory $formFactory)
    {
        $this->repository = $movieRepository;
        $this->formFactory = $formFactory;
    }

    public function handle(Command $command): void
    {
        $exploitationVisa = (string) $command->exploitationVisa;
        $title = (string) $command->title;
        $year = (int) $command->year;

        $submittedData = Utils::camelizeArray(json_decode($command->json, true));

        $form = $this->formFactory->create(CommandType::class, $command, ['data_class' => get_class($command)]);
        $form->submit($submittedData);

        if (!$form->isValid()) {
            throw new NotValidFormException($form);
        }

        $movie = MovieCreate::handle($exploitationVisa, $title, $year);
        $this->repository->create($movie);
    }
}
