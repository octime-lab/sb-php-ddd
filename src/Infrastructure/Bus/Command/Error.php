<?php

namespace App\Infrastructure\Bus\Command;

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
