<?php

namespace App\Domain\Shared\Specification;

use App\Domain\Entity\DomainEntity;

class OrSpecification extends Specification
{
    /**
     * @var SpecificationInterface
     */
    private $specification1;

    /**
     * @var SpecificationInterface
     */
    private $specification2;

    public function __construct(SpecificationInterface $specification1, SpecificationInterface $specification2)
    {
        $this->specification1 = $specification1;
        $this->specification2 = $specification2;
    }

    public function isSatisfiedBy(DomainEntity $entity): bool
    {
        return $this->specification1->isSatisfiedBy($entity) || $this->specification2->isSatisfiedBy($entity);
    }
}
