<?php

namespace App\Domain\Shared\Specification;

use App\Domain\Shared\Entity\DomainEntity;

interface SpecificationInterface
{
    public function isSatisfiedBy(DomainEntity $entity): bool;

    public function andSpecification(SpecificationInterface $specification): SpecificationInterface;

    public function orSpecification(SpecificationInterface $specification): SpecificationInterface;

    public function notSpecification(): SpecificationInterface;
}
