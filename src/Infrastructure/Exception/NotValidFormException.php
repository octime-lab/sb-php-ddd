<?php

namespace App\Infrastructure\Exception;

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
