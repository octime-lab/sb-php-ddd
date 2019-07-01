<?php

declare(strict_types=1);

namespace App\Application\Query;

use App\Domain\Shared\Bus\Query\Response;
use App\Domain\Shared\Query\Exception\NotFoundException;

class Collection implements Response
{
    public $page;
    public $limit;
    public $total;
    public $data;

    public function __construct(int $page, int $limit, int $total, array $data)
    {
        $this->page = $page;
        $this->limit = $limit;
        $this->total = $total;
        $this->data = $data;
    }
}
