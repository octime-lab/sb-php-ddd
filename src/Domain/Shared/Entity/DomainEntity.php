<?php

namespace App\Domain\Shared\Entity;

use App\Domain\Shared\ValueObject\Uuid;

abstract class DomainEntity implements DomainEntityInterface
{
    protected $id;

    private $domainEvents = [];

    public function __construct(?Uuid $id)
    {
        $this->id = $id;
    }

    public function id(): ?string
    {
        if (null === $this->id) {
            return null;
        }

        return $this->id->value();
    }

    final public function pullDomainEvents(): array
    {
        $domainEvents       = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    final protected function record(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }

    public function attributes(): array
    {
        return array_keys(get_object_vars($this));
    }

    public function equals(DomainEntityInterface $entity): bool
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
