<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;

class ReviewRepository
{
    public function findAllByProduct(Product $product): Collection
    {
        return Review::where('product_id', $product->id)->get();
    }
}
