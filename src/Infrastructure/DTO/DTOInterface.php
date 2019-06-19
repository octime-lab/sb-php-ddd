<?php

namespace App\Infrastructure\DTO;

use App\Domain\Shared\AggregateRoot;
use PommProject\ModelManager\Model\FlexibleEntity\FlexibleEntityInterface;

interface DTOInterface
{
    public function domainToFlexible(AggregateRoot $dEntity): FlexibleEntityInterface;

    public function flexibleToDomain(FlexibleEntityInterface $fEntity): AggregateRoot;
}
