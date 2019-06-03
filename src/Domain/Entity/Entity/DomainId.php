<?php

namespace App\Domain\Entity\Entity;

final class DomainId implements DomainIdInterface
{
    /**
     * @var string
     */
    private $value;

    public function __construct(?string $value)
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
