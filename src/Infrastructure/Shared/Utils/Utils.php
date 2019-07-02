<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Utils;

class Utils
{
    public static function camelizeArray(array $oldValues): array
    {
        $newValues = [];

        foreach ($oldValues as $key => $oldValue) {
            $newValues[\App\Domain\Shared\Utils::camelize($key)] = $oldValue;
        }

        return $newValues;
    }
}
