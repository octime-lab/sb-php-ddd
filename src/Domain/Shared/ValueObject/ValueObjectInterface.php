<?php

namespace App\Domain\Shared\ValueObject;

interface ValueObjectInterface
{
    public function __toString(): string;

    public function equalsTo(ValueObjectInterface $object): bool;

    public function getValue(): string;
}
