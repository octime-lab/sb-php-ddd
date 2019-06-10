<?php

namespace App\Domain\Specification;

use App\Domain\Entity\DomainEntity;

class NotSpecification extends Specification
{
    /**
     * @var SpecificationInterface
     */
    private $specification;

    public function __construct(SpecificationInterface $specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy(DomainEntity $entity): bool
    {
        return !$this->specification->isSatisfiedBy($entity);
    }
}