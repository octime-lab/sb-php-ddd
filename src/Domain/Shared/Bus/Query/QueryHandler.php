<?php

declare(strict_types=1);

namespace App\Domain\Shared\Bus\Query;

interface QueryHandler
{
    public function handle(Query $query): Response;
}
