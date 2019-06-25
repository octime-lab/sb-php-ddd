<?php

declare(strict_types=1);

namespace App\UI\Http\Controller;

use App\Domain\Shared\Bus\Command\Command;
use App\Domain\Shared\Bus\Query\Query;
use App\Domain\Shared\Bus\Query\Response;
use App\Infrastructure\Shared\Bus\Command\CommandBusSymfonySync as CommandBus;
use App\Infrastructure\Shared\Bus\Query\QueryBusSymfonySync as QueryBus;
use App\UI\Http\Response\JsonApiFormatter;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class RestController extends AbstractController
{
    protected $serializer;
    protected $commandBus;
    protected $queryBus;
    protected $formatter;

    public function __construct(
        SerializerInterface $serializer,
        CommandBus $commandBus,
        QueryBus $queryBus,
        JsonApiFormatter $formatter
    ) {
        $this->serializer = $serializer;
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
        $this->formatter = $formatter;
    }

    protected function ask(Query $query): Response
    {
        return $this->queryBus->ask($query);
    }

    protected function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }

    protected function jsonResponse(Response $item): JsonResponse
    {
        return JsonResponse::create($this->formatter->one($item));
    }
}
