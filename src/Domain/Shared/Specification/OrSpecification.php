<?php

namespace App\Domain\Shared\Specification;

use App\Domain\Shared\AggregateRoot;

class OrSpecification extends Specification
{
    private $specification1;

    private $specification2;

    public function __construct(SpecificationInterface $specification1, SpecificationInterface $specification2)
    {
        $this->specification1 = $specification1;
        $this->specification2 = $specification2;
    }

    public function isSatisfiedBy(AggregateRoot $entity): bool
    {
        return $this->specification1->isSatisfiedBy($entity) || $this->specification2->isSatisfiedBy($entity);
    }
}
