<?php

namespace App\UI\Http\Controller;

use App\Infrastructure\Bus\Command\CommandBusAsync as CommandBus;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RestController extends AbstractController
{
    protected $serializer;

    protected $commandBus;

    public function __construct(SerializerInterface $serializer, CommandBus $commandBus)
    {
        $this->serializer = $serializer;
        $this->commandBus = $commandBus;
    }
}
