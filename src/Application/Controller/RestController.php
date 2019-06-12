<?php

namespace App\Application\Controller;

use App\Application\Command\CommandBus;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RestController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /*
     * @var CommandBus
     */
    protected $commandBus;

    public function __construct(SerializerInterface $serializer, CommandBus $commandBus)
    {
        $this->serializer = $serializer;
        $this->commandBus = $commandBus;
    }
}
