<?php
// Hiện lỗi PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://127.0.0.1:8000");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Preflight CORS
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

require __DIR__ . '/vendor/autoload.php';

// Load ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');
$dotenv->load();

// Load Controllers
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use App\Controllers\ProductImageController;

// Khởi tạo Controller
$product = new ProductController();
$category = new CategoryController();
$image = new ProductImageController();
$controller = new ProductController();

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];

// -------------------------
// PRODUCT ROUTES
// -------------------------

// POST /product_images → create lưu đường dẫn ảnh vào DB
if ($uri === "/product_images" && $method === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($image->storeImage($data));
    exit;
}


// GET /products → list
if ($uri === "/products" && $method === "GET") {
    echo json_encode($product->getAllProducts());
    exit;
}
/**
 * BULK PRODUCTS – cho Wishlist service
 */
if ($uri === '/products/bulk' && $method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $ids  = $data['ids'] ?? [];

    echo json_encode(
        $controller->getProductsByIds($ids)
    );
    exit;
}

// GET /products/{id}
if (preg_match("#^/products/(\d+)$#", $uri, $matches) && $method === "GET") {
    echo json_encode($product->getProductById((int)$matches[1]));
    exit;
}

// POST /products → create
if ($uri === "/products" && $method === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($product->createProduct($data));
    exit;
}

// PUT /products/{id}
if (preg_match("#^/products/(\d+)$#", $uri, $matches) && $method === "PUT") {
    $id = (int)$matches[1];
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode(["ok" => false, "message" => "Dữ liệu JSON không hợp lệ"]);
        exit;
    }

    // Nếu trong dữ liệu gửi lên có 'model_url', bạn có thể viết thêm logic update riêng hoặc gộp vào
    echo json_encode($product->updateProduct($id, $data));
    exit;
}

// DELETE /products/{id}
if (preg_match("#^/products/(\d+)$#", $uri, $matches) && $method === "DELETE") {
    echo json_encode($product->deleteProduct((int)$matches[1]));
    exit;
}


// -------------------------
// CATEGORY ROUTES
// -------------------------

// GET /categories
if ($uri === "/categories" && $method === "GET") {
    echo json_encode($category->getAllCategories());
    exit;
}

// POST /categories (THÊM MỚI)
if ($uri === "/categories" && $method === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($category->createCategory($data));
    exit;
}

// PUT /categories/{id} (SỬA)
if (preg_match("#^/categories/(\d+)$#", $uri, $matches) && $method === "PUT") {
    $id = (int)$matches[1];
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($category->updateCategory($id, $data));
    exit;
}

// DELETE /categories/{id} (XÓA)
if (preg_match("#^/categories/(\d+)$#", $uri, $matches) && $method === "DELETE") {
    echo json_encode($category->deleteCategory((int)$matches[1]));
    exit;
}

// GET /categories/{id}
if (preg_match("#^/categories/(\d+)$#", $uri, $matches) && $method === "GET") {
    echo json_encode($category->getCategoryById((int)$matches[1]));
    exit;
}


// GET /products/category/{id}
if (preg_match("#^/products/category/(\d+)$#", $uri, $matches) && $method === "GET") {
    echo json_encode($product->getProductsByCategoryId((int)$matches[1]));
    exit;
}


// -------------------------
// PRODUCT_IMAGES ROUTES
// -------------------------

// GET /product_images
if ($uri === "/product_images" && $method === "GET") {
    echo json_encode($image->getAllImages());
    exit;
}

// GET /product_images/{id}
if (preg_match("#^/product_images/(\d+)$#", $uri, $matches) && $method === "GET") {
    echo json_encode($image->getImageById($matches[1]));
    exit;
}

// GET /products/latest
if ($uri === "/products/latest" && $method === "GET") {
    echo json_encode($product->getLatestProducts());
    exit;
}

// GET /products/top-rated
if ($uri === "/products/top-rated" && $method === "GET") {
    echo json_encode($product->getTopRated(4));
    exit;
}

// GET /products/category/{id}/limit/{n}
if (preg_match("#^/products/category/(\d+)/limit/(\d+)$#", $uri, $matches) && $method === "GET") {
    echo json_encode($product->getProductsByCategoryLimit((int)$matches[1], (int)$matches[2]));
    exit;
}

// GET /products/filter → filter + pagination
if ($uri === "/products/filter" && $method === "GET") {
    echo json_encode($product->getFilteredProducts());
    exit;
}

// GET /products/{id}/primary-image
if (preg_match("#^/products/(\d+)/primary-image$#", $uri, $matches) && $method === "GET") {
    echo json_encode($image->getPrimaryImage((int)$matches[1]));
    exit;
}

// GET /categories/{id}
// if (preg_match("#^/categories/(\d+)$#", $uri, $matches) && $method === "GET") {
//     echo json_encode($category->getCategoryById((int)$matches[1]));
//     exit;
// }

// POST /products/decrease-stock
if ($method === 'POST' && $uri === '/api/products/decrease-stock') {
    $data = json_decode(file_get_contents('php://input'), true);
    echo json_encode($product->decreaseStock($data['items']));
    exit;
}

// HOÀN HÀNG
if ($method === 'POST' && $uri === '/api/products/restore-stock') {
    $data = json_decode(file_get_contents('php://input'), true);
    echo json_encode($product->restoreStock($data['items']));
    exit;
}

// PUT /products/{id}/rating
if (preg_match("#^/products/(\d+)/rating$#", $uri, $matches) && $method === "PUT") {
    $data = json_decode(file_get_contents('php://input'), true);
    echo json_encode(
        $product->updateRating((int)$matches[1], $data)
    );
    exit;
}

// POST /product_images/upsert
if ($uri === "/product_images/upsert" && $method === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($image->upsertImage($data));
    exit;
}

// DELETE /product_images/{product_id}/{display_order}
if (preg_match("#^/product_images/(\d+)/(\d+)$#", $uri, $matches) && $method === "DELETE") {
    $res = $image->deleteImageByOrder((int)$matches[1], (int)$matches[2]);
    echo json_encode($res ?: ["ok" => true]); // Đảm bảo không bao giờ trống
    exit;
}


// Mặc định
echo json_encode(["status" => "Product service running"]);
