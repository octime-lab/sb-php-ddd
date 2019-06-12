<?php

namespace App\Domain\Shared\Entity;

interface DomainEntityInterface
{
    public function getDomainId(): DomainIdInterface;

    public function getDomainIdValue(): string;

    public function toArray(): array;

    public function getAttributes(): array;

    public function duplicate(): self;

    public function equals(DomainEntityInterface $other): bool;
}
