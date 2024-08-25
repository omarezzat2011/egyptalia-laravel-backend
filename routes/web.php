<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\EmailController;



Route::prefix('api/v1/products')->group(function () {
    Route::get('all', [ProductController::class, 'getAllProducts']);
    Route::get('top', [ProductController::class, 'getTop3Products']);
});

Route::prefix('api/v1/reviews')->group(function () {
    Route::post('add', [ReviewController::class, 'addReview']);
});

Route::get('/', function () {
    return response()->file(public_path('static/index.html'));
});


Route::post('/send-email', [EmailController::class, 'sendEmail']);

Route::post('/token', function () {
    return csrf_token();
});

