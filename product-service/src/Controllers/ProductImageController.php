<?php

namespace App\Controllers;

use App\Database;
use PDO;

class ProductImageController {

    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function getAllImages() {
        $sql = "SELECT * FROM product_images";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getImageById($id) {
        $sql = "SELECT * FROM product_images WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: ["error" => "No images found"];
    }
}
