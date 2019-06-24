<?php

namespace App\Domain\Shared\Bus\Command;

abstract class Command
{
    public function __get(string $name): void
    {
        if (property_exists($this, $name)) {
            $this->$name;
        }
    }

    public function loadFromArray(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function toArray(): array
    {
        $arrayObject = new \ArrayObject($this);

        return $arrayObject->getArrayCopy();
    }

    public function __set(string $name, string $value = null): void
    {
        $this->$name = $value ?? '';
    }

    public function __isset(string $name): void
    {
    }
}
