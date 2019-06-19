<?php

namespace App\Domain\BoundedContext\Movie;

use App\Domain\Shared\DomainError;

class MovieNotFound extends DomainError
{
    private $id;

    public function __construct(MovieId $id)
    {
        $this->id = $id;
        $this->code = static::NOT_FOUND;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'movie_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('The movie <%s> has not been found', $this->id->value());
    }
}
