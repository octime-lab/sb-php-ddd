<?php

namespace App\Infrastructure\Utils;

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
