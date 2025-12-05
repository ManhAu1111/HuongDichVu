<?php

namespace App\Helpers;

class RatingHelper
{
    public static function normalize($rating)
    {
        $full = floor($rating);
        $decimal = $rating - $full;

        if ($decimal <= 0.2) {
            $normalized = $full;
        } elseif ($decimal <= 0.7) {
            $normalized = $full + 0.5;
        } else {
            $normalized = $full + 1;
        }

        return min($normalized, 5);
    }

    public static function render($rating)
    {
        $rating = self::normalize($rating);

        $full = floor($rating);
        $half = ($rating - $full == 0.5) ? 1 : 0;
        $empty = 5 - $full - $half;

        $html = "";

        for ($i = 0; $i < $full; $i++) {
            $html .= '<i class="fas fa-star"></i>';
        }

        if ($half) {
            $html .= '<i class="fas fa-star-half-alt"></i>';
        }

        for ($i = 0; $i < $empty; $i++) {
            $html .= '<i class="far fa-star"></i>';
        }

        return $html;
    }
}
