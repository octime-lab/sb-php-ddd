<?php

namespace App\Domain\Shared\Entity;

interface DomainEntityInterface
{
    public function domainId(): DomainIdInterface;

    public function domainIdValue(): string;

    public function attributes(): array;

    public function duplicate(): self;

    public function equals(DomainEntityInterface $other): bool;
}
