<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Bus\Command;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['name' => 'command_type']);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        foreach (get_object_vars($options['data']) as $key => $value) {
            $builder->add($key);
        }
    }
}
