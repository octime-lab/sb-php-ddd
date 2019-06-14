<?php

namespace App\Domain\Shared\Entity;

abstract class DomainEntity implements DomainEntityInterface
{
    /**
     * @var DomainIdInterface|null
     */
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
        return $this->domainId->getId();
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
        if (null !== $entity->getDomainIdValue() && null !== $this->getDomainIdValue()) {
            return $entity->getDomainIdValue() === $this->getDomainIdValue();
        }

        return false;
    }

    public function isNew(): bool
    {
        return null === $this->getDomainIdValue();
    }
}
