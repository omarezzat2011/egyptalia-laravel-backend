<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function addReview(Request $request): Response
    {
        $reviewRequest = $request->all();
        $response = $this->reviewService->addReviewForProduct($reviewRequest);
        return $response;
    }
}
