<?php

namespace App\Application\EventListener;

use App\Infrastructure\Exception\NotValidFormException;
use App\Infrastructure\Representation\Representation\VndErrorCollectionRepresentation;
use App\Infrastructure\Representation\Representation\VndErrorValidationRepresentation;
use App\Infrastructure\Service\Serializer\FormErrorsSerializer;
use Hateoas\Representation\VndErrorRepresentation;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Translation\Translator;

final class ExceptionListener
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var Translator
     */
    private $translator;

    /**
     * @var FormErrorsSerializer
     */
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

    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception = $event->getException();

        switch (true) {
            case $exception instanceof NotValidFormException:
                $this->handleNotValidFormException($event, $exception);
                break;
            case $exception instanceof HttpException:
                $this->handleHttpException($event, $exception);
                break;
            default:
                $this->handleException($event, $exception);
        }
    }

    private function handleException(GetResponseForExceptionEvent $event, \Exception $exception): void
    {
        $event->setResponse(
            new Response(
                $this->serializer->serialize(
                    new VndErrorRepresentation(
                        $this->translator->trans($exception->getMessage(),
                            [],
                            'generic'
                        )
                    ), 'json'),
                Response::HTTP_INTERNAL_SERVER_ERROR,
                ['Content-Type' => 'application/json']
            )
        );
    }

    private function handleHttpException(GetResponseForExceptionEvent $event, HttpException $exception): void
    {
        $event->setResponse(
            new JsonResponse(
                $this->serializer->serialize(
                    new VndErrorRepresentation(
                        $this->translator->trans($exception->getMessage(),
                    [],
                    'generic'
                )), 'json'),
                $exception->getStatusCode(),
                [],
                true
            )
        );
    }

    private function handleNotValidFormException(
        GetResponseForExceptionEvent $event,
        NotValidFormException $exception
    ): void {
        $formErrors = $this->formErrorsSerializer->serializeFormErrors($exception->getForm());

        $errorValidationRepresentations = [];

        foreach ($formErrors['global'] as $error) {
            $message = $this->translator->trans($error, []);

            if ($message === $error) {
                $message = $this->translator->trans($error, [], 'generic');
            }

            $errorValidationRepresentations[] = new VndErrorValidationRepresentation($message, null);
        }

        foreach ($formErrors['fields'] as $field => $error) {
            $message = $this->translator->trans($error, []);

            if ($message === $error) {
                $message = $this->translator->trans($error, [], 'generic');
            }

            $errorValidationRepresentations[] = new VndErrorValidationRepresentation($message, $field);
        }

        $errorCollectionRepresentation = new VndErrorCollectionRepresentation(
            $this->translator->trans('Validation failed', [], 'generic'),
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
