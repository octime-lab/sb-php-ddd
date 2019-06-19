<?php

namespace App\Application\EventListener;

use App\Domain\Shared\DomainError;
use App\Infrastructure\Exception\NotValidFormException;
use App\Infrastructure\Representation\VndError\VndErrorCollectionRepresentation;
use App\Infrastructure\Representation\VndError\VndErrorValidationRepresentation;
use App\Infrastructure\Serializer\FormErrorsSerializer;
use Exception;
use Hateoas\Representation\VndErrorRepresentation;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Translation\Translator;

final class ExceptionListener
{
    private $serializer;

    private $translator;

    private $formErrorsSerializer;

    public function __construct(
        SerializerInterface $serializer,
        Translator $translator,
        FormErrorsSerializer $formErrorsSerializer
    ) {
        $this->serializer = $serializer;
        $this->translator = $translator;
        $this->formErrorsSerializer = $formErrorsSerializer;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getException();

        switch (true) {
            case $exception instanceof NotValidFormException:
                $this->handleNotValidFormException($event, $exception);
                break;
            case $exception instanceof HttpException:
                $this->handleHttpException($event, $exception);
                break;
            case $exception instanceof DomainError:
                $this->handleDomainException($event, $exception);
                break;
            default:
                $this->handleException($event, $exception);
        }
    }

    private function handleException(ExceptionEvent $event, Exception $exception): void
    {
        $event->setResponse(
            new Response(
                $this->serializer->serialize(
                    new VndErrorRepresentation(
                        $this->translator->trans($exception->getMessage(),
                            [],
                            'domain'
                        )
                    ), 'json'),
                Response::HTTP_INTERNAL_SERVER_ERROR,
                ['Content-Type' => 'application/json']
            )
        );
    }

    private function handleHttpException(ExceptionEvent $event, HttpException $exception): void
    {
        $event->setResponse(
            new JsonResponse(
                $this->serializer->serialize(
                    new VndErrorRepresentation(
                        $this->translator->trans($exception->getMessage(),
                    [],
                    'domain'
                )), 'json'),
                $exception->getStatusCode(),
                [],
                true
            )
        );
    }

    private function handleDomainException(ExceptionEvent $event, DomainError $exception): void
    {
        $event->setResponse(
            new JsonResponse(
                $this->serializer->serialize(
                    new VndErrorRepresentation(
                        $this->translator->trans($exception->errorCode(),
                    [],
                    'domain'
                )), 'json'),
                $exception->getCode(),
                [],
                true
            )
        );
    }

    private function handleNotValidFormException(
        ExceptionEvent $event,
        NotValidFormException $exception
    ): void {
        $formErrors = $this->formErrorsSerializer->serializeFormErrors($exception->getForm());

        $errorValidationRepresentations = [];

        foreach ($formErrors['global'] as $error) {
            $message = $this->translator->trans($error, []);

            if ($message === $error) {
                $message = $this->translator->trans($error, [], 'domain');
            }

            $errorValidationRepresentations[] = new VndErrorValidationRepresentation($message, null);
        }

        foreach ($formErrors['fields'] as $field => $error) {
            $message = $this->translator->trans($error, []);

            if ($message === $error) {
                $message = $this->translator->trans($error, [], 'domain');
            }

            $errorValidationRepresentations[] = new VndErrorValidationRepresentation($message, $field);
        }

        $errorCollectionRepresentation = new VndErrorCollectionRepresentation(
            $this->translator->trans('Validation failed', [], 'domain'),
            $errorValidationRepresentations
        );

        $event->setResponse(
            new JsonResponse(
                $this->serializer->serialize($errorCollectionRepresentation, 'json'),
                Response::HTTP_UNPROCESSABLE_ENTITY,
                [],
                true
            )
        );
    }
}
