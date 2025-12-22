<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Review
{

    public static function create($data)
    {
        $db = Database::connect();

        $stmt = $db->prepare("
            INSERT INTO reviews (product_id, user_id, user_name, rating, comment)
            VALUES (?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data['product_id'],
            $data['user_id'],
            $data['user_name'],
            $data['rating'],
            $data['comment']
        ]);
    }

    // UPDATED: sort + ép kiểu rating
    public static function getByProduct($productId, $sort = 'newest')
    {
        $db = Database::connect();

        $orderBy = $sort === 'best'
            ? 'rating DESC'
            : 'created_at DESC';

        $stmt = $db->prepare("
            SELECT user_name, rating, comment, created_at
            FROM reviews
            WHERE product_id = ?
            ORDER BY $orderBy
        ");
        $stmt->execute([$productId]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($r) {
            return [
                'user_name'  => $r['user_name'],
                'rating'     => (float)$r['rating'], // ⭐ FIX
                'comment'    => $r['comment'],
                'created_at' => $r['created_at']
            ];
        }, $rows);
    }

    public static function stats($productId)
    {
        $db = Database::connect();

        $stmt = $db->prepare("
        SELECT 
            COUNT(*) AS total,
            IFNULL(ROUND(AVG(rating), 1), 0) AS avg_rating
        FROM reviews
        WHERE product_id = ?
    ");

        $stmt->execute([$productId]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            'total' => (int) $row['total'],
            'avg_rating' => (float) $row['avg_rating']
        ];
    }


    // UPDATED: check reviewed
    public static function exists($productId, $userId)
    {
        $db = Database::connect();

        $stmt = $db->prepare("
            SELECT id FROM reviews
            WHERE product_id = ? AND user_id = ?
            LIMIT 1
        ");
        $stmt->execute([$productId, $userId]);

        return (bool)$stmt->fetch();
    }
}
