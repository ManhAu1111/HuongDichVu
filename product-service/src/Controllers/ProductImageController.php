<?php

namespace App\Controllers;

use App\Database;
use PDO;
use PDOException;

class ProductImageController
{

    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function getAllImages()
    {
        $sql = "SELECT * FROM product_images";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function storeImage($data)
    {
        try {
            $sql = "INSERT INTO product_images (product_id, image_url, is_primary, display_order) 
                VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['product_id'],
                $data['image_url'],
                $data['is_primary'] ?? 0,
                $data['display_order'] ?? 1
            ]);
            return ["ok" => true, "message" => "Image stored"];
        } catch (PDOException $e) {
            return ["ok" => false, "error" => $e->getMessage()];
        }
    }
    public function getImageById($id)
    {
        $sql = "SELECT * FROM product_images WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: ["error" => "No images found"];
    }

    public function getPrimaryImage($productId)
    {
        $sql = "SELECT image_url 
            FROM product_images 
            WHERE product_id = ? 
            ORDER BY is_primary DESC, display_order ASC 
            LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$productId]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return ["image_url" => null];
        }

        return ["image_url" => str_replace("\\", "/", $row['image_url'])];
    }

    public function upsertImage($data)
    {
        try {
            // Sử dụng ON DUPLICATE KEY UPDATE để ghi đè nếu trùng product_id và display_order
            // Lưu ý: Bạn cần đảm bảo bảng product_images đã có UNIQUE KEY cho cặp (product_id, display_order)
            $sql = "INSERT INTO product_images (product_id, image_url, is_primary, display_order) 
                VALUES (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                image_url = VALUES(image_url), 
                is_primary = VALUES(is_primary)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['product_id'],
                $data['image_url'],
                $data['is_primary'] ?? 0,
                $data['display_order']
            ]);
            return ["ok" => true, "message" => "Image upserted successfully"];
        } catch (PDOException $e) {
            return ["ok" => false, "error" => $e->getMessage()];
        }
    }

    public function deleteImageByOrder($productId, $displayOrder)
    {
        try {
            $sql = "DELETE FROM product_images WHERE product_id = ? AND display_order = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$productId, $displayOrder]);
            return ["ok" => true, "message" => "Image at position $displayOrder deleted"];
        } catch (PDOException $e) {
            return ["ok" => false, "error" => $e->getMessage()];
        }
    }
}
