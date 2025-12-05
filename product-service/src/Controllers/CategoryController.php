<?php

namespace App\Controllers;

use App\Database;
use PDO;

class CategoryController {

    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function getAllCategories() {
        // bảng đúng là: categories
        $sql = "SELECT * FROM categories";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: ["error" => "Category not found"];
    }
}
