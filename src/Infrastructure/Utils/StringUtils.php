<?php

namespace App\Infrastructure\Utils;

class StringUtils
{
    public static function camelizeArray(array $oldValues): array
    {
        $newValues = [];

        foreach ($oldValues as $key => $oldValue) {
            $newValues[static::camelize($key)] = $oldValue;
        }

        return $newValues;
    }

    public static function camelize(string $input, string $separator = '_'): string
    {
        return lcfirst(str_replace($separator, '', ucwords($input, $separator)));
    }
}
