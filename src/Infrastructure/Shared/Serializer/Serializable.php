<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Serializer;

interface Serializable
{
    public static function deserialize(array $data);

    public function serialize(): array;
}
