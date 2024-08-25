<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->renderable(function (Throwable $e, Request $request) {
            return $this->handleException($e, $request);
        });
    }

    protected function handleException(Throwable $e, Request $request): JsonResponse
    {
        $statusCode = $e instanceof \Illuminate\Http\Exceptions\HttpResponseException ? $e->getStatusCode() : 500;
        $message = $e->getMessage() ?: 'An unexpected error occurred';
        $path = $request->path();
        $apiError = new ApiError($path, $message, $statusCode);

        return $apiError->toResponse();
    }
}
