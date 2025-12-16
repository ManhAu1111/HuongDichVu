<?php

namespace App\Controllers;

use App\Database;
use PDO;

class WishlistController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function index(int $userId)
    {
        $sql = "
    SELECT 
    w.product_id,
    p.name,
    p.price,
    pi.image_url AS thumbnail
FROM wishlists w
JOIN products p ON p.id = w.product_id
LEFT JOIN product_images pi 
    ON pi.product_id = p.id AND pi.is_primary = 1
WHERE w.user_id = :user_id

";


        $stmt = $this->db->prepare($sql);
        $stmt->execute(["user_id" => $userId]);

        echo json_encode([
            "ok" => true,
            "data" => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ]);
    }

    public function store(int $userId, int $productId)
    {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO wishlists (user_id, product_id) VALUES (:u, :p)"
            );
            $stmt->execute([
                "u" => $userId,
                "p" => $productId
            ]);

            http_response_code(201);
            echo json_encode(["ok" => true, "message" => "Added to wishlist"]);
        } catch (\PDOException $e) {
            http_response_code(409);
            echo json_encode(["ok" => false, "message" => "Already in wishlist"]);
        }
    }

    public function destroy(int $userId, int $productId)
    {
        $stmt = $this->db->prepare(
            "DELETE FROM wishlists WHERE user_id = :u AND product_id = :p"
        );
        $stmt->execute([
            "u" => $userId,
            "p" => $productId
        ]);

        echo json_encode(["ok" => true, "message" => "Removed from wishlist"]);
    }
}