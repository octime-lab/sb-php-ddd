<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Bus\Query;

use App\Domain\Shared\Bus\Query\Query;
use App\Domain\Shared\Bus\Query\QueryHandler;
use App\Domain\Shared\Bus\Query\QueryBus;
use App\Domain\Shared\Bus\Query\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;

class QueryBusSymfonySync implements QueryBus
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function ask(Query $query): Response
    {
        return $this->getHandler($query)->handle($query);
    }

    private function getHandler(Query $query): QueryHandler
    {
        $queryClassName = substr(
            get_class($query),
            strrpos(get_class($query), '\\') + 1,
            strlen(get_class($query))
        );

        $handlerClass =
            'App\Application\Query\\'.
            $this->getNameFolder($queryClassName).
            '\\'.
            $queryClassName.
            'Handler'
        ;

        return $this->container->get($handlerClass);
    }

    private function getNameFolder(string $queryClassName): string
    {
        $nbCharacters = strlen($queryClassName);
        $nameFolder = '';

        for ($i = 0; $i < $nbCharacters; ++$i) {
            $letter = $queryClassName[$i];

            if (0 === $i && ctype_upper($letter)) {
                $nameFolder .= $letter;
            } elseif (ctype_upper($letter)) {
                break;
            } else {
                $nameFolder .= $letter;
            }
        }

        return $nameFolder;
    }
}
