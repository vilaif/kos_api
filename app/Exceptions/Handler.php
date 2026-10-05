<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends Exception
{
    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            $statusCode = 500;
            $payload = [
                'status' => false,
                'message' => $exception->getMessage(),
            ];

            // Error Validation
            if ($exception instanceof ValidationException) {
                $statusCode = 422;
                $payload = [
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' => $exception->errors(),
                ];

                // Error Authentication
            } elseif ($exception instanceof AuthenticationException) {
                $statusCode = 401;
                $payload = [
                    'status' => false,
                    'message' => 'Unauthenticated'
                ];

                // Error Authorization
            } elseif ($exception instanceof AuthorizationException) {
                $statusCode = 403;
                $payload = [
                    'status' => false,
                    'message' => 'Unauthorized',
                ];
            }

            return response()->json($payload, $statusCode);
        }

        return response()->json([
            'status' => false,
            'message' => $exception->getMessage(),
        ], 500);
    }
}