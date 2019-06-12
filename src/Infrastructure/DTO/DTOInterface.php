<?php

namespace App\Infrastructure\DTO;

use App\Domain\Shared\Entity\DomainEntityInterface;
use PommProject\ModelManager\Model\FlexibleEntity\FlexibleEntityInterface;

interface DTOInterface
{
    public function domainToFlexible(DomainEntityInterface $dEntity): FlexibleEntityInterface;

    public function flexibleToDomain(FlexibleEntityInterface $fEntity): DomainEntityInterface;
}
