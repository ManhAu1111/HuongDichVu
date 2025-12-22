<?php

namespace App\Helpers;

class RatingHelper
{
    public static function render($rating): string
    {
        if ($rating === null) {
            $rating = 0;
        }

        $rating = (float) $rating;

        // Giới hạn rating từ 0 → 5
        if ($rating < 0) $rating = 0;
        if ($rating > 5) $rating = 5;

        $fullStars = floor($rating);
        $hasHalf   = ($rating - $fullStars) >= 0.5 ? 1 : 0;
        $emptyStars = 5 - $fullStars - $hasHalf;

        $html = '';

        // Full stars
        for ($i = 0; $i < $fullStars; $i++) {
            $html .= '<i class="fas fa-star"></i>';
        }

        // Half star
        if ($hasHalf) {
            $html .= '<i class="fas fa-star-half-alt"></i>';
        }

        // Empty stars
        for ($i = 0; $i < $emptyStars; $i++) {
            $html .= '<i class="far fa-star"></i>';
        }

        return $html;
    }
}