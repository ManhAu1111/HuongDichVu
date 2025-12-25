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
}
