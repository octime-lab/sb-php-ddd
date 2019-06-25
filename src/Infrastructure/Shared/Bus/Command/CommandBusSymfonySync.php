<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Bus\Command;

use App\Domain\Shared\Bus\Command\Command;
use App\Domain\Shared\Bus\Command\CommandBus;
use App\Domain\Shared\Bus\Command\CommandHandler;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class CommandBusSymfonySync implements CommandBus
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function dispatch(Command $command): void
    {
        $this->getHandler($command)->handle($command);
    }

    private function getHandler(Command $command): CommandHandler
    {
        $commandClassName = substr(
            get_class($command),
            strrpos(get_class($command), '\\') + 1,
            strlen(get_class($command))
        );

        $handlerClass =
            'App\Application\Command\\'.
            $this->getNameFolder($commandClassName).
            '\\'.
            $commandClassName.
            'Handler'
        ;

        return $this->container->get($handlerClass);
    }

    private function getNameFolder(string $commandClassName): string
    {
        $nbCharacters = strlen($commandClassName);
        $nameFolder = '';

        for ($i = 0; $i < $nbCharacters; ++$i) {
            $letter = $commandClassName[$i];

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
