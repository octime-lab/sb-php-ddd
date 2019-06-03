<?php

namespace App\Domain\Entity\Entity;

interface DomainEntityInterface
{
    public function getDomainIdValue(): ?string;

    public function toArray(): array;

    public function getAttributes(): array;

    public function duplicate(): self;

    public function equals(DomainEntityInterface $other): bool;
}
