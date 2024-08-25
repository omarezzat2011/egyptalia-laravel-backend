<?php

namespace App\Exceptions;
use Illuminate\Http\JsonResponse;

class ApiError
{
    public $path;
    public $message;
    public $statusCode;
    public $zonedDateTime;
    public $errors;

    public function __construct($path, $message, $statusCode, $errors = [])
    {
        $this->path = $path;
        $this->message = $message;
        $this->statusCode = $statusCode;
        $this->zonedDateTime = now();
        $this->errors = $errors;
    }

    public function toResponse(): JsonResponse
    {
        return response()->json([
            'path' => $this->path,
            'message' => $this->message,
            'statusCode' => $this->statusCode,
            'zonedDateTime' => $this->zonedDateTime,
            'errors' => $this->errors,
        ], $this->statusCode);
    }
}
