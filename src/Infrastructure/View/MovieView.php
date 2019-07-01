<?php

declare(strict_types=1);

namespace App\Infrastructure\View;

use App\Infrastructure\Shared\ReadModel\SerializableReadModel;
use App\Infrastructure\Shared\Serializer\Serializable;
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
        $instance->uuid = Uuid::fromString($data['id']);
        $instance->exploitationVisa = new MovieExploitationVisa($data['exploitation_visa']);
        $instance->title = new MovieTitle($data['title']);
        $instance->year = new MovieYear($data['year']);

        return $instance;
    }

    public function serialize(): array
    {
        return [
            'uuid' => $this->getId(),
            'exploitation_visa' => $this->exploitationVisa->value(),
            'title' => $this->title->value(),
            'year' => $this->year->value(),
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
