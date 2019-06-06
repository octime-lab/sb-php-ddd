<?php

namespace App\Domain\ValueObject;

interface ValueObjectInterface
{
    public function __toString(): string;

    public function equalsTo(ValueObjectInterface $object): bool;

    public function getValue(): string;
}
