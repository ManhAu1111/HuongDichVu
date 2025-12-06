<?php

namespace App\Controllers;

use App\Database;
use PDO;

class ProductController
{

    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function getAllProducts()
    {
        $db = (new \App\Database())->connect();

        $stmt = $db->prepare("
            SELECT p.*,
                (SELECT image_url 
                FROM product_images 
                WHERE product_id = p.id AND is_primary = 1
                LIMIT 1) AS primary_image
            FROM products p
        ");

        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Convert \ → /
        foreach ($products as &$p) {
            if ($p['primary_image']) {
                $p['primary_image'] = str_replace("\\", "/", $p['primary_image']);
            }
        }

        return $products;
    }


    public function getProductById($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: ["error" => "Product not found"];
    }

    public function createProduct($data)
    {
        $sql = "INSERT INTO products (name, price, image, description, category_id)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['name'],
            $data['price'],
            $data['image'],
            $data['description'],
            $data['category_id']
        ]);

        return ["ok" => true, "message" => "Product created"];
    }

    public function updateProduct($id, $data)
    {
        $sql = "UPDATE products 
                SET name=?, price=?, image=?, description=?, category_id=?
                WHERE id=?";
        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $data['name'],
            $data['price'],
            $data['image'],
            $data['description'],
            $data['category_id'],
            $id
        ]);

        return ["ok" => true, "message" => "Product updated"];
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return ["ok" => true, "message" => "Product deleted"];
    }

    public function getProductsByCategoryId($categoryId)
    {
        $sql = "SELECT * FROM products WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLatestProducts($limit = 6)
    {
        $stmt = $this->db->prepare("
            SELECT p.*,
                (SELECT image_url 
                FROM product_images 
                WHERE product_id = p.id AND is_primary = 1
                LIMIT 1) AS primary_image
            FROM products p
            ORDER BY created_at DESC
            LIMIT ?
        ");
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as &$p) {
            if ($p['primary_image']) {
                $p['primary_image'] = str_replace("\\", "/", $p['primary_image']);
            }
        }
        return $products;
    }

    public function getTopRated($limit = 4)
    {
        $db = (new \App\Database())->connect();

        $stmt = $db->prepare("
            SELECT p.*,
                (SELECT image_url 
                    FROM product_images 
                    WHERE product_id = p.id AND is_primary = 1
                    LIMIT 1
                ) AS primary_image
            FROM products p
            ORDER BY avg_rating DESC
            LIMIT ?
        ");

        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // fix path
        foreach ($products as &$p) {
            if ($p['primary_image']) {
                $p['primary_image'] = str_replace("\\", "/", $p['primary_image']);
            }
        }

        return $products;
    }

    public function getProductsByCategoryLimit($categoryId, $limit = 4)
    {
        $sql = "
            SELECT p.*,
                (SELECT image_url 
                FROM product_images 
                WHERE product_id = p.id AND is_primary = 1
                LIMIT 1) AS primary_image
            FROM products p
            WHERE p.category_id = ?
            LIMIT ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as &$p) {
            if ($p['primary_image']) {
                $p['primary_image'] = str_replace("\\", "/", $p['primary_image']);
            }
        }

        return $products;
    }

    public function getFilteredProducts()
    {
        $db = (new \App\Database())->connect();

        $category   = $_GET['category'] ?? null;
        $price_min  = $_GET['price_min'] ?? null;
        $price_max  = $_GET['price_max'] ?? null;
        $limit      = $_GET['limit'] ?? 12;
        $page       = $_GET['page'] ?? 1;
        $search     = $_GET['search'] ?? null;

        $offset = ($page - 1) * $limit;

        $sql = "
            SELECT p.*,
                (SELECT image_url 
                FROM product_images 
                WHERE product_id = p.id AND is_primary = 1
                LIMIT 1) AS primary_image
            FROM products p
            WHERE 1 = 1
        ";

        $params = [];

        if (!empty($category)) {
            $sql .= " AND p.category_id = ? ";
            $params[] = $category;
        }

        if (!empty($price_min)) {
            $sql .= " AND p.price >= ? ";
            $params[] = $price_min;
        }

        if (!empty($price_max)) {
            $sql .= " AND p.price <= ? ";
            $params[] = $price_max;
        }

        $search = $_GET['search'] ?? null;

        if (!empty($search)) {
            $sql .= " AND p.name LIKE ? ";
            $params[] = "%$search%";
        }


        // Count
        $countSql = "SELECT COUNT(*) FROM ($sql) AS temp";
        $countStmt = $db->prepare($countSql);
        $countStmt->execute($params);
        $total = $countStmt->fetchColumn();

        $sql .= " LIMIT $limit OFFSET $offset ";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as &$p) {
            if ($p['primary_image']) {
                $p['primary_image'] = str_replace("\\", "/", $p['primary_image']);
            }
        }

        return [
            "data" => $products,
            "total" => $total,
            "per_page" => $limit,
            "current_page" => $page,
            "last_page" => ceil($total / $limit)
        ];
    }
}
