<?php
// ===============================
// CORS CONFIG (FIXED)
// ===============================
header("Content-Type: application/json");

// CHỈ ĐỊNH RÕ ORIGIN (KHÔNG DÙNG *)
header("Access-Control-Allow-Origin: http://127.0.0.1:8000");

// BẮT BUỘC cho Authorization
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// CÁC METHOD ĐƯỢC PHÉP
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Cho phép browser gửi cookie / token
header("Access-Control-Allow-Credentials: true");

// ===============================
// PRE-FLIGHT REQUEST
// ===============================
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
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
use App\Controllers\WishlistController;
use App\Helpers\AuthHelper;
use App\Controllers\ReviewController;

// Khởi tạo Controller
$product = new ProductController();
$category = new CategoryController();
$image = new ProductImageController();
$controller = new ProductController();


$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];

$wishlist = new WishlistController();
// -------------------------
// PRODUCT ROUTES
// -------------------------

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
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($product->updateProduct((int)$matches[1], $data));
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


// -------------------------
// WISHLIST ROUTES
// -------------------------

$wishlist = new WishlistController();

// GET /wishlist
if ($uri === "/wishlist" && $method === "GET") {
    $userId = AuthHelper::getUserIdFromToken();
    $wishlist->index($userId);
    exit;
}

// POST /wishlist/{productId}
// DELETE /wishlist/{productId}
if (preg_match("#^/wishlist/(\d+)$#", $uri, $matches)) {
    $userId = AuthHelper::getUserIdFromToken();
    $productId = (int)$matches[1];

    if ($method === "POST") {
        $wishlist->store($userId, $productId);
        exit;
    }

    if ($method === "DELETE") {
        $wishlist->destroy($userId, $productId);
        exit;
    }
}

// -------------------------
// REVIEW ROUTES
// -------------------------

// GET reviews
if (preg_match('#^/products/(\d+)/reviews$#', $uri, $m) && $method === 'GET') {
    echo json_encode($review->index((int)$m[1]));
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


// Mặc định
echo json_encode(["status" => "Product service running"]);