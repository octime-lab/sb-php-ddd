<?php

namespace App\Domain\Specification;

abstract class Specification implements SpecificationInterface
{
    public function andSpecification(SpecificationInterface $specification): SpecificationInterface
    {
        return new AndSpecification($this, $specification);
    }

    public function orSpecification(SpecificationInterface $specification): SpecificationInterface
    {
        return new OrSpecification($this, $specification);
    }

    public function notSpecification(): SpecificationInterface
    {
        return new NotSpecification($this);
    }
}
