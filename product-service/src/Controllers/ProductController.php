<?php

namespace App\Controllers;

use App\Database;
use PDO;
use PDOException;



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
        try {
            // Thêm trường model_url và các trường đánh giá với giá trị mặc định là 0
            $sql = "INSERT INTO products (name, price, description, category_id, quantity, model_url, avg_rating, total_reviews, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                $data['name'],
                $data['price'],
                $data['description'],
                $data['category_id'],
                $data['quantity'],
                $data['model_url'] ?? null, // Model URL có thể trống lúc khởi tạo
                0, // avg_rating mặc định là 0
                0  // total_reviews mặc định là 0
            ]);

            // Trả về ID vừa tạo để Frontend có thể dùng làm tên thư mục lưu file
            return [
                "ok" => true,
                "id" => $this->db->lastInsertId(),
                "message" => "Sản phẩm đã được tạo thành công"
            ];
        } catch (PDOException $e) {
            return [
                "ok" => false,
                "error" => $e->getMessage()
            ];
        }
    }

    // public function updateModelUrl($id, $modelUrl)
    // {
    //     $sql = "UPDATE products SET model_url = ? WHERE id = ?";
    //     $stmt = $this->db->prepare($sql);
    //     return $stmt->execute([$modelUrl, $id]);
    // }

    public function updateProduct($id, $data)
    {
        try {
            $fields = [];
            $params = [];

            // Kiểm tra từng trường, nếu có trong $data thì mới đưa vào câu UPDATE
            $allowedFields = ['name', 'price', 'description', 'category_id', 'quantity', 'model_url'];

            foreach ($allowedFields as $field) {
                if (array_key_exists($field, $data)) {
                    $fields[] = "$field = ?";
                    $params[] = $data[$field];
                }
            }

            if (empty($fields)) {
                return ["ok" => false, "message" => "Không có dữ liệu để cập nhật"];
            }

            // Thêm ID vào cuối mảng params cho mệnh đề WHERE
            $params[] = $id;
            $sql = "UPDATE products SET " . implode(', ', $fields) . ", updated_at = CURRENT_TIMESTAMP WHERE id = ?";

            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute($params);

            return ["ok" => true, "message" => "Cập nhật thành công"];
        } catch (PDOException $e) {
            return ["ok" => false, "message" => "Lỗi: " . $e->getMessage()];
        }
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

    // Tồn kho

    public function decreaseStock($items)
    {
        try {
            $this->db->beginTransaction();

            foreach ($items as $item) {

                // Kiểm tra đủ hàng hay không
                $check = $this->db->prepare("
                    SELECT quantity FROM products WHERE id = ?
                ");
                $check->execute([$item['product_id']]);
                $qty = $check->fetchColumn();

                if ($qty < $item['quantity']) {
                    $this->db->rollBack();
                    return ["error" => "Not enough stock for product ID " . $item['product_id']];
                }

                // Trừ hàng
                $stmt = $this->db->prepare("
                    UPDATE products
                    SET quantity = quantity - ?
                    WHERE id = ?
                ");
                $stmt->execute([$item['quantity'], $item['product_id']]);
            }

            $this->db->commit();
            return ["message" => "Stock decreased"];
        } catch (PDOException $e) {
            $this->db->rollBack();
            return ["error" => $e->getMessage()];
        }
    }


    // ===============================
    // KHÔI PHỤC TỒN KHO (HUỶ ĐƠN)
    // ===============================
    public function restoreStock($items)
    {
        try {
            $this->db->beginTransaction();

            foreach ($items as $item) {
                $stmt = $this->db->prepare("
                    UPDATE products
                    SET quantity = quantity + ?
                    WHERE id = ?
                ");
                $stmt->execute([$item['quantity'], $item['product_id']]);
            }

            $this->db->commit();
            return ["message" => "Stock restored"];
        } catch (PDOException $e) {
            $this->db->rollBack();
            return ["error" => $e->getMessage()];
        }
    }
    // ===============================
    // BULK PRODUCTS (for Wishlist)
    // ===============================
    public function getProductsByIds(array $ids)
    {
        if (empty($ids)) {
            return [];
        }

        // Tạo placeholders ?,?,?
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $sql = "
        SELECT p.*,
            (
                SELECT image_url
                FROM product_images
                WHERE product_id = p.id AND is_primary = 1
                LIMIT 1
            ) AS primary_image
        FROM products p
        WHERE p.id IN ($placeholders)
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($ids);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as &$p) {
            if ($p['primary_image']) {
                $p['primary_image'] = str_replace("\\", "/", $p['primary_image']);
            }
        }

        return $products;
    }
    public function updateRating($id, $data)
    {
        $stmt = $this->db->prepare("
        UPDATE products
        SET avg_rating = ?, total_reviews = ?
        WHERE id = ?
    ");

        $stmt->execute([
            $data['avg_rating'],
            $data['total_reviews'],
            $id
        ]);

        return ['ok' => true];
    }
}
