<?php

namespace App\Domain\Specification;

use App\Domain\Entity\DomainEntity;

interface SpecificationInterface
{
    public function isSatisfiedBy(DomainEntity $entity): bool;

    public function andSpecification(SpecificationInterface $specification): SpecificationInterface;

    public function orSpecification(SpecificationInterface $specification): SpecificationInterface;

    public function notSpecification(): SpecificationInterface;
}
