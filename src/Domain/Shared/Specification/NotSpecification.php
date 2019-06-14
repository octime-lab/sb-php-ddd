<?php

namespace App\Domain\Shared\Specification;

use App\Domain\Shared\Entity\DomainEntity;

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
