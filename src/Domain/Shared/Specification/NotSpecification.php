<?php

namespace App\Domain\Shared\Specification;

use App\Domain\Shared\AggregateRoot;

class NotSpecification extends Specification
{
    private $specification;

    public function __construct(SpecificationInterface $specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy(AggregateRoot $entity): bool
    {
        return !$this->specification->isSatisfiedBy($entity);
    }
}
