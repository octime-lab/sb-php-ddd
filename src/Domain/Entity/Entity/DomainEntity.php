<?php

namespace App\Domain\Entity\Entity;

abstract class DomainEntity implements DomainEntityInterface
{
    /**
     * @var DomainEntityIdInterface|null
     */
    protected $id;

    public function __construct(int $id = null)
    {
        $this->id = new DomainEntityId($id);
    }

    public function getId(): ?DomainEntityIdInterface
    {
        return $this->id;
    }

    public function getIdValue(): ?int
    {
        if (null === $this->id) {
            return null;
        }

        return $this->id->getValue();
    }

    public function toArray(): array
    {
        $objVars = get_object_vars($this);
        $objVars['id'] = null !== $this->getId() ? $this->getId()->getValue() : null;

        return $objVars;
    }

    public function getAttributes(): array
    {
        return array_keys(get_object_vars($this));
    }

    public function duplicate(): DomainEntityInterface
    {
        return clone $this;
    }

    public function equals(DomainEntityInterface $entity): bool
    {
        if (null !== $entity->getId()->getValue() && null !== $this->getId()->getValue()) {
            return $entity->getId()->getValue() === $this->getId()->getValue();
        }

        return false;
    }

    public function isNew(): bool
    {
        return null === $this->getIdValue();
    }
}
