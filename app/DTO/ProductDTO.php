<?php

namespace App\DTO;

class ProductDTO
{
    public $id;
    public $name;
    public $price;
    public $description;
    public $rating;
    public $imgUrl;
    public $reviewersNumber;

    public function __construct(
        $id,
        $name,
        $price,
        $description,
        $rating,
        $imgUrl,
        $reviewersNumber
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->rating = $rating;
        $this->imgUrl = $imgUrl;
        $this->reviewersNumber = $reviewersNumber;
    }
}
