<?php

namespace App\Domain\Shared\Bus\Query;

use Symfony\Component\HttpFoundation\JsonResponse;

interface QueryBus
{
    public function ask(Query $query): JsonResponse;
}
