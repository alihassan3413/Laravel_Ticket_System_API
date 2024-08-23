<?php

namespace App\Exceptions;

use App\Traits\ApiResponses;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CustomException
{
    use ApiResponses;

    public function handleException($request, Throwable $exception): JsonResponse
    {
        $statusCode = 500; // Default status code

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $statusCode = 422; // Unprocessable Entity
        } elseif ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $statusCode = 401; // Unauthorized
        } elseif ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $statusCode = 404; // Not Found
        }

        return $this->error($exception->getMessage(), $statusCode);
    }
}
