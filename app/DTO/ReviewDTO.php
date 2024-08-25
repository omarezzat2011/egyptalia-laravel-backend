<?php

namespace App\DTO;

class ReviewDTO
{
    public $numberOfReviewers;
    public $newAverageRating;

    public function __construct($numberOfReviewers, $newAverageRating)
    {
        $this->numberOfReviewers = $numberOfReviewers;
        $this->newAverageRating = $newAverageRating;
    }
}
