<?php

namespace App\Domain\Entity\Entity;

interface DomainEntityIdInterface
{
    public function getValue(): ?string;
}
