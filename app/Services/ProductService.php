<?php

namespace App\Services;

use App\DTO\ProductDTO;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

//    public function getAllProducts(): array
//    {
//        $productDTOs = [];
//        $products = $this->productRepository->findAll();
//
//        foreach ($products as $product) {
//            if (is_null($product->price)) {
//                $productDTOs[] = new ProductDTO(
//                    $product->id,
//                    $product->name,
//                    $product->description,
//                    $product->rating,
//                    $product->imgUrl,
//                    $product->reviews()->count()
//                );
//            } else {
//                $productDTOs[] = new ProductDTO(
//                    $product->id,
//                    $product->name,
//                    $product->price,
//                    $product->description,
//                    $product->rating,
//                    $product->imgUrl,
//                    $product->reviews()->count()
//                );
//            }
//        }
//
//        return $productDTOs;
//    }

    public function getTop3Products(): array
    {
        return $this->productRepository->findTop3Products()->all();
    }
    public function getAllProducts(): array
    {
        return $this->productRepository->findAllProducts()->items();
    }

    public function getProductById(int $id): ?Product
    {
        return $this->productRepository->find($id);
    }
}
