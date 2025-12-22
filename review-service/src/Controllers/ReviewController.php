<?php

namespace App\Controllers;

use App\Models\Review;
use App\Helpers\AuthHelper;

class ReviewController
{

    // POST /reviews


    public static function store()
    {
        // 🔐 LẤY USER TỪ AUTH
        $user = AuthHelper::user();

        $data = json_decode(file_get_contents('php://input'), true);

        if (
            empty($data['product_id']) ||
            !isset($data['rating']) ||
            empty($data['comment'])
        ) {
            http_response_code(422);
            echo json_encode(['message' => 'Missing fields']);
            exit;
        }

        if ($data['rating'] < 1 || $data['rating'] > 5) {
            http_response_code(422);
            echo json_encode(['message' => 'Invalid rating']);
            exit;
        }

        Review::create([
            'product_id' => (int)$data['product_id'],
            'user_id'    => (int)$user->sub,
            'user_name'  => $user->fullname,
            'rating'     => (float)$data['rating'],
            'comment'    => trim($data['comment'])
        ]);
        // ===============================
        // 1. TÍNH AVG + TOTAL REVIEW
        // ===============================
        $stats = Review::stats((int)$data['product_id']);

        $payload = [
            'avg_rating'    => round((float)$stats['avg_rating'], 1),
            'total_reviews' => (int)$stats['total']
        ];

        // ===============================
        // 2. GỌI PRODUCT SERVICE UPDATE
        // ===============================
        $ch = curl_init("http://127.0.0.1:8003/products/{$data['product_id']}/rating");

        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode($payload)
        ]);

        curl_exec($ch);
        curl_close($ch);

        // ===============================
        echo json_encode(['message' => 'Review submitted']);
    }



    // GET /reviews/{product_id}?sort=best|newest
    public static function index($productId)
    {
        $sort = $_GET['sort'] ?? 'newest';

        $reviews = Review::getByProduct($productId, $sort);
        $stats   = Review::stats($productId);

        echo json_encode([
            'total'          => (int)$stats['total'],
            'average_rating' => $stats['avg_rating']
                ? round((float)$stats['avg_rating'], 1)
                : 0,
            'reviews'        => $reviews
        ]);
    }

    // GET /reviews/check/{product_id}?user_id=xx
    public static function check($productId)
    {
        $userId = $_GET['user_id'] ?? null;

        if (!$userId) {
            echo json_encode(['reviewed' => false]);
            return;
        }

        $reviewed = Review::exists($productId, (int)$userId);

        echo json_encode(['reviewed' => $reviewed]);
    }
}
