<?php

namespace App\Infrastructure\Service\DTO\DTO;

use App\Domain\Entity\Entity\DomainEntityInterface;
use PommProject\ModelManager\Model\FlexibleEntity\FlexibleEntityInterface;

interface DTOInterface
{
    public function domainToFlexible(DomainEntityInterface $dEntity): FlexibleEntityInterface;

    public function flexibleToDomain(FlexibleEntityInterface $fEntity): DomainEntityInterface;
}
