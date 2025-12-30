<?php

namespace App\Controllers;

use App\Database;
use PDO;

class CategoryController
{

    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function createCategory($data)
    {
        try {
            $sql = "INSERT INTO categories (name, slug) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['name'],
                $data['slug']
            ]);

            return [
                "ok" => true,
                "id" => $this->db->lastInsertId(),
                "message" => "Danh mục đã được tạo thành công"
            ];
        } catch (\PDOException $e) {
            return ["ok" => false, "error" => $e->getMessage()];
        }
    }

    public function updateCategory($id, $data)
    {
        try {
            $sql = "UPDATE categories SET name = ?, slug = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['name'],
                $data['slug'],
                $id
            ]);

            return ["ok" => true, "message" => "Cập nhật danh mục thành công"];
        } catch (\PDOException $e) {
            return ["ok" => false, "error" => $e->getMessage()];
        }
    }
    public function deleteCategory($id)
    {
        try {
            // Kiểm tra xem có sản phẩm nào đang thuộc danh mục này không
            $checkSql = "SELECT COUNT(*) FROM products WHERE category_id = ?";
            $checkStmt = $this->db->prepare($checkSql);
            $checkStmt->execute([$id]);
            if ($checkStmt->fetchColumn() > 0) {
                return ["ok" => false, "message" => "Không thể xóa: Danh mục đang chứa sản phẩm."];
            }

            $sql = "DELETE FROM categories WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            return ["ok" => true, "message" => "Xóa danh mục thành công"];
        } catch (\PDOException $e) {
            return ["ok" => false, "error" => $e->getMessage()];
        }
    }
    public function getAllCategories()
    {
        try {
            $sql = "SELECT * FROM categories";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function getCategoryById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: ["error" => "Category not found"];
    }
}
