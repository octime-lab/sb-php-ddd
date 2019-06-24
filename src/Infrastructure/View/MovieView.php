<?php

namespace App\Infrastructure\View;

use Broadway\ReadModel\SerializableReadModel;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use App\Domain\BoundedContext\Movie\MovieExploitationVisa;
use App\Domain\BoundedContext\Movie\MovieTitle;
use App\Domain\BoundedContext\Movie\MovieYear;

class MovieView implements SerializableReadModel
{
    private $uuid;
    private $exploitationVisa;
    private $title;
    private $year;

    public static function fromSerializable(Serializable $event): self
    {
        return self::deserialize($event->serialize());
    }

    public static function deserialize(array $data): self
    {
        $instance = new self();
        $instance->uuid = Uuid::fromString($data['uuid']);
        $instance->exploitationVisa = new MovieExploitationVisa($data['exploitation_visa']);
        $instance->title = new MovieTitle($data['title']);
        $instance->year = new MovieYear($data['year']);

        return $instance;
    }

    public function serialize(): array
    {
        return [
            'uuid' => $this->getId(),
        ];
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getId(): string
    {
        return $this->uuid->toString();
    }
}
