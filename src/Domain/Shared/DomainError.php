<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use DomainException;

abstract class DomainError extends DomainException
{
    public const NOT_FOUND = 404;

    public function __construct()
    {
        parent::__construct($this->errorMessage());
    }

    abstract public function errorCode(): string;

    abstract protected function errorMessage(): string;
}
