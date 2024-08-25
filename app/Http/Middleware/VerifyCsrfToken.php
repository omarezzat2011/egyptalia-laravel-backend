<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Log;

class VerifyCsrfToken extends Middleware
{


    protected $except = [
        'http://127.0.0.1:8000/send-email', // This should match your form submission route
        'send-email',
    ];

}

