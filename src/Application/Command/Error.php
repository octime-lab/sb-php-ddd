<?php

namespace App\Application\Command;

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(required={"message"}, type="object")
 */
class Error extends \Exception
{
    /**
     * @var string
     *
     * @SWG\Property(type="string")
     */
    public $message;
}
