<?php

namespace App\Domain\Entity\Entity;

interface DomainIdInterface
{
    public function getValue(): ?string;

    public function resetId(): void;
}
