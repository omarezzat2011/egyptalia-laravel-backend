<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'name',
        'message',
        'rating',
        'product_id'
    ];

    public $timestamps = false;

    // Define relationship with Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
