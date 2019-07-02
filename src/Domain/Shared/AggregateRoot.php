<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use App\Domain\Shared\ValueObject\Uuid;

abstract class AggregateRoot
{
    protected $id;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id->value();
    }

    public function attributes(): array
    {
        return array_keys(get_object_vars($this));
    }

    public function equals(self $entity): bool
    {
        if (null !== $entity->id() && null !== $this->id()) {
            return $entity->id() === $this->id();
        }

        return false;
    }

    public function isNew(): bool
    {
        return null === $this->id();
    }
}
