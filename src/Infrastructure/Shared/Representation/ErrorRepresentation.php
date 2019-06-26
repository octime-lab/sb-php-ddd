<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Representation;

use JMS\Serializer\Annotation as Serializer;

class ErrorRepresentation
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $message;
    /**
     * @Serializer\Expose
     * @Serializer\XmlAttribute
     * @Serializer\Type("int")
     */
    private $logref;
    private $about;
    private $help;
    private $describes;

    public function __construct(
        string $message,
        ?int $logref = null,
        ?string $help = null,
        ?string $describes = null,
        ?string $about = null
    ) {
        $this->message = $message;
        $this->logref = $logref;
        $this->help = $help;
        $this->describes = $describes;
        $this->about = $about;
    }

    public function getHelp(): ?string
    {
        return $this->help;
    }

    public function getDescribes(): ?string
    {
        return $this->describes;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getLogref(): ?int
    {
        return $this->logref;
    }
}
