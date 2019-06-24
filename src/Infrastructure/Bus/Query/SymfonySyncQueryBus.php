<?php

namespace App\Infrastructure\Bus\Command;

use App\Domain\Shared\Bus\Query\Query;
use App\Domain\Shared\Bus\Query\QueryBus;
use App\Domain\Shared\Bus\Query\Response;

class SymfonySyncQueryBus implements QueryBus
{
    public function __construct()
    {
    }

    public function ask(Query $query): ?Response
    {
    }
}
