<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'rating',
        'imgUrl'
    ];

    public $timestamps = false;

    // Define relationship with Review
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // Method to update rating based on reviews
    public function updateRating(): void
    {
        $ratings = $this->reviews->pluck('rating');
        $this->rating = $ratings->average();
        $this->save();
    }

    // Optional toString equivalent in Laravel
    public function __toString(): string
    {
        return "Product{id={$this->id}, name={$this->name}, description={$this->description}}";
    }
}
