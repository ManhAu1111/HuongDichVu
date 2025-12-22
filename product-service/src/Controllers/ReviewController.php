<?php

namespace App\Controllers;

use App\Database;
use App\Helpers\AuthHelper;
use PDO;

class ReviewController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    /**
     * GET /products/{id}/reviews
     */
    public function index(int $productId): array
{
    // Lấy reviews
    $stmt = $this->db->prepare("
        SELECT 
            id,
            user_name,
            rating,
            comment,
            created_at
        FROM product_reviews
        WHERE product_id = ?
        ORDER BY created_at DESC
    ");
    $stmt->execute([$productId]);
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Stats
    $stmt = $this->db->prepare("
        SELECT 
            ROUND(AVG(rating), 1) AS avg_rating,
            COUNT(*) AS total
        FROM product_reviews
        WHERE product_id = ?
    ");
    $stmt->execute([$productId]);
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);

    return [
        'ok' => true,
        'data' => [
            'avg_rating' => (float) ($stats['avg_rating'] ?? 0),
            'total'      => (int) ($stats['total'] ?? 0),
            'reviews'    => $reviews
        ]
    ];
}




    /**
     * POST /products/{id}/reviews
     */
    public function store(int $productId): array
{
    $user = AuthHelper::getUserFromToken(); // object JWT
    $userId = $user->sub;

    $data = json_decode(file_get_contents("php://input"), true);
    $rating  = $data['rating'] ?? null;
    $comment = $data['comment'] ?? '';

    if (!$rating || $rating < 1 || $rating > 5) {
        http_response_code(422);
        return ['ok' => false, 'message' => 'Rating must be between 1 and 5'];
    }

    // ✅ CHECK DUPLICATE (PHẢI Ở TRƯỚC)
    $check = $this->db->prepare("
        SELECT id FROM product_reviews
        WHERE product_id = ? AND user_id = ?
    ");
    $check->execute([$productId, $userId]);

    if ($check->fetch()) {
        http_response_code(409);
        return ['ok' => false, 'message' => 'You already reviewed this product'];
    }

    // ✅ INSERT
    $stmt = $this->db->prepare("
        INSERT INTO product_reviews
        (product_id, user_id, user_name, rating, comment)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $productId,
        $userId,
        $user->fullname ?? 'Anonymous',
        $rating,
        $comment
    ]);

    // ✅ RECALCULATE
    $this->recalculateRating($productId);

    return [
        'ok' => true,
        'message' => 'Review added successfully'
    ];
}


    /**
     * Recalculate avg_rating & total_reviews
     */
    private function recalculateRating(int $productId): void
    {
        $stmt = $this->db->prepare("
            SELECT 
                ROUND(AVG(rating), 1) AS avg_rating,
                COUNT(*) AS total_reviews
            FROM product_reviews
            WHERE product_id = ?
        ");
        $stmt->execute([$productId]);
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->db->prepare("
            UPDATE products
            SET avg_rating = ?, total_reviews = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $stats['avg_rating'] ?? 0,
            $stats['total_reviews'] ?? 0,
            $productId
        ]);
    }
}