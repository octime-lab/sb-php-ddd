<?php

namespace App\Domain\Shared;

class Utils
{
    public static function camelize(string $input, string $separator = '_'): string
    {
        return lcfirst(str_replace($separator, '', ucwords($input, $separator)));
    }

    public static function reindex(callable $fn, array $coll): array
    {
        $result = [];

        foreach ($coll as $key => $value) {
            $result[$fn($value, $key)] = $value;
        }

        return $result;
    }
}
