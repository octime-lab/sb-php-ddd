<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\ReadModel;

use App\Infrastructure\Shared\Serializer\Serializable;

interface SerializableReadModel extends Serializable, Identifiable
{
}
