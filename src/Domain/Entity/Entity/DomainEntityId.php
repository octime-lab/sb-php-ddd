<?php

namespace App\Domain\Entity\Entity;

class DomainEntityId implements DomainEntityIdInterface
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value = null)
    {
        $this->value = $value;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function resetId(): void
    {
        $this->value = null;
    }
}
