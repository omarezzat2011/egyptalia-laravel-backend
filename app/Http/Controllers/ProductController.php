<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getAllProducts()
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products, 200);
    }

    public function getTop3Products()
    {
        $topProducts = $this->productService->getTop3Products();
        return response()->json($topProducts, 200);
    }
}
