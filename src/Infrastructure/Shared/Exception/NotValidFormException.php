<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Exception;

use Symfony\Component\Form\FormInterface;

class NotValidFormException extends \Exception
{
    private $form;

    public function __construct(FormInterface $form)
    {
        $this->form = $form;
    }

    public function getForm(): FormInterface
    {
        return $this->form;
    }
}
