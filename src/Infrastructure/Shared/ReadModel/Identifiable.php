<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\ReadModel;

interface Identifiable
{
    public function getId(): string;
}
