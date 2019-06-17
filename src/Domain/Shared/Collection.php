<?php

namespace App\Domain\Shared;

use App\Domain\Shared\Entity\DomainEntityInterface;
use ArrayObject;

abstract class Collection extends ArrayObject
{
    protected $entityClass;

    public function __construct(string $entityClass)
    {
        $this->entityClass = $entityClass;

        parent::__construct();
    }

    public function exists(DomainEntityInterface $entity): bool
    {
        $this->checkInstance($entity);

        foreach ($this as $cEntity) {
            if ($entity->equals($cEntity)) {
                return true;
            }
        }

        return false;
    }

    public function add(DomainEntityInterface $entity): void
    {
        $this->checkInstance($entity);

        if (!$this->exists($entity)) {
            parent::append($entity);
        }
    }

    public function remove(DomainEntityInterface $entity): void
    {
        $this->checkInstance($entity);

        foreach ($this as $index => $cEntity) {
            if ($entity->equals($cEntity)) {
                $this->offsetUnset($index);
            }
        }
    }

    private function checkInstance(DomainEntityInterface $entity): void
    {
        if (!(is_a($entity, $this->entityClass))) {
            throw new \Exception(
                'EntityCollection instance error : '
                .get_class($entity).
                ' VS '.
                $this->entityClass);
        }
    }
}
