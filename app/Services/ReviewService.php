<?php

namespace App\Services;

use App\DTO\ReviewDTO;
use App\Models\Review;
use App\Models\Product;
use App\Repositories\ReviewRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ReviewService
{
    protected $reviewRepository;
    protected $productRepository;

    public function __construct(ReviewRepository $reviewRepository, ProductRepository $productRepository)
    {
        $this->reviewRepository = $reviewRepository;
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(): array
    {
        return $this->reviewRepository->findAll()->toArray();
    }

    public function getReviewById(int $id): ?Review
    {
        return $this->reviewRepository->find($id);
    }

    public function addReviewForProduct(array $reviewRequest): Response
    {
        $validator = Validator::make($reviewRequest, [
            'productId' => 'required|integer|min:1',
            'message' => 'required|string',
            'name' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $product = $this->productRepository->find($reviewRequest['productId']);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $review = new Review([
            'product_id' => $product->id,
            'message' => $reviewRequest['message'],
            'name' => $reviewRequest['name'],
            'rating' => $reviewRequest['rating']
        ]);

        $this->reviewRepository->save($review);

        // Update the product's rating
        $product->updateRating();
        $this->productRepository->save($product);

        $reviewDTO = new ReviewDTO(
            $product->reviews()->count(),
            $product->rating
        );

        return response()->json($reviewDTO, 200);
    }
}
