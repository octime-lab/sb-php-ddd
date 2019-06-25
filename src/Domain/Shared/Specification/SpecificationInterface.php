<?php

declare(strict_types=1);

namespace App\Domain\Shared\Specification;

use App\Domain\Shared\AggregateRoot;

interface SpecificationInterface
{
    public function isSatisfiedBy(AggregateRoot $entity): bool;

    public function andSpecification(SpecificationInterface $specification): SpecificationInterface;

    public function orSpecification(SpecificationInterface $specification): SpecificationInterface;

    public function notSpecification(): SpecificationInterface;
}
