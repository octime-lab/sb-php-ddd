<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Representation;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class VndErrorValidationRepresentation
{
    /**
     * @var string
     *
     * @Serializer\Expose
     */
    private $field;

    /**
     * @var string
     *
     * @Serializer\Expose
     */
    private $message;

    public function __construct(string $message, string $field = null)
    {
        $this->field = $field;
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getField(): ?string
    {
        return $this->field;
    }
}
