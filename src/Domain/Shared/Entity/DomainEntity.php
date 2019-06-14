<?php

namespace App\Domain\Shared\Entity;

abstract class DomainEntity implements DomainEntityInterface
{
    protected $domainId;

    public function __construct(DomainIdInterface $domainId)
    {
        $this->domainId = $domainId;
    }

    public function domainId(): DomainIdInterface
    {
        return $this->domainId;
    }

    public function domainIdValue(): string
    {
        return $this->domainId->id();
    }

    public function attributes(): array
    {
        return array_keys(get_object_vars($this));
    }

    public function duplicate(): DomainEntityInterface
    {
        return clone $this;
    }

    public function equals(DomainEntityInterface $entity): bool
    {
        if (null !== $entity->domainIdValue() && null !== $this->domainIdValue()) {
            return $entity->domainIdValue() === $this->domainIdValue();
        }

        return false;
    }

    public function isNew(): bool
    {
        return null === $this->domainIdValue();
    }
}
