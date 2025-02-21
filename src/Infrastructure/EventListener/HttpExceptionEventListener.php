<?php

namespace App\Infrastructure\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class HttpExceptionEventListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if ($exception instanceof HttpException) {
            $data = ['error' => $exception->getMessage()];
            if ($exception instanceof BadRequestHttpException) {
                $data = ['errors' => json_decode($exception->getMessage())];
            }

            $response = new JsonResponse(
                $data,
                $exception->getStatusCode()
            );

            $event->setResponse($response);
        }
    }
}
