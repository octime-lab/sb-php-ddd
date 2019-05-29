<?php

namespace App\Domain\Specification\Specification;

use App\Domain\Entity\Entity\DomainEntity;

interface SpecificationInterface
{
    public function isSatisfiedBy(DomainEntity $entity): bool;

    public function andSpecification(SpecificationInterface $specification): SpecificationInterface;

    public function orSpecification(SpecificationInterface $specification): SpecificationInterface;

    public function notSpecification(): SpecificationInterface;
}
