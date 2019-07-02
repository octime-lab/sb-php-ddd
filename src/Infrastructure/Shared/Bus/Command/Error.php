<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Bus\Command;

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(required={"message"}, type="object")
 */
class Error extends \Exception
{
    /**
     * @SWG\Property(type="string")
     */
    public $message;
}
