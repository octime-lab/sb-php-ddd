<?php

namespace App\Infrastructure\Serializer;

use Symfony\Component\Form\Form;

final class FormErrorsSerializer
{
    public function serializeFormErrors(
        Form $form,
        bool $flatArray = false,
        bool $addFormName = false,
        string $glueKeys = '_'
    ): array {
        $errors = [];
        $errors['global'] = [];
        $errors['fields'] = [];

        foreach ($form->getErrors() as $error) {
            $errors['global'][] = $error->getMessage();
        }

        $errors['fields'] = $this->serialize($form);

        if ($flatArray) {
            $errors['fields'] = $this->arrayFlatten($errors['fields'],
                $glueKeys, (($addFormName) ? $form->getName() : ''));
        }

        return $errors;
    }

    private function serialize(Form $form): array
    {
        $localErrors = [];

        foreach ($form->getIterator() as $key => $child) {
            foreach ($child->getErrors() as $error) {
                $localErrors[$key] = $error->getMessage();
            }

            if (count($child->getIterator()) > 0) {
                $localErrors[$key] = $this->serialize($child);
            }
        }

        return $localErrors;
    }

    private function arrayFlatten(array $array, string $separator = '_', string $flattenedKey = ''): array
    {
        $flattenedArray = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $flattenedArray = array_merge($flattenedArray,
                    $this->arrayFlatten($value, $separator,
                        (strlen($flattenedKey) > 0 ? $flattenedKey.$separator : '').$key)
                );
            } else {
                $flattenedArray[(strlen($flattenedKey) > 0 ? $flattenedKey.$separator : '').$key] = $value;
            }
        }

        return $flattenedArray;
    }
}
