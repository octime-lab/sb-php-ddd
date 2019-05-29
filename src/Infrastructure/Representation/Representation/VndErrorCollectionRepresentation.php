<?php

namespace App\Infrastructure\Representation\Representation;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class VndErrorCollectionRepresentation
{
    /**
     * @var string
     *
     * @Serializer\Expose
     */
    private $message;

    /**
     * @var array
     *
     * @Serializer\Expose
     */
    private $errors;

    public function __construct(string $message, array $errors)
    {
        $this->message = $message;
        $this->errors = $errors;
    }
}
