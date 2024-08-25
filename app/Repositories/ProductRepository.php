<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository
{
    public function findTop3Products(int $perPage = 3): LengthAwarePaginator
    {
        return Product::query()
            ->paginate($perPage);
    }
    public function findAllProducts()
    {
        return Product::query()
            ->paginate(10);
    }
}
