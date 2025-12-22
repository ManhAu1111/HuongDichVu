<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\ReviewController;
use Dotenv\Dotenv;

$origin = $_SERVER['HTTP_ORIGIN'] ?? 'http://127.0.0.1:8000';
header("Access-Control-Allow-Origin: $origin");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

// /reviews
if ($uri[0] !== 'reviews') {
    http_response_code(404);
    exit;
}

// POST /reviews
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ReviewController::store();
    exit;
}

// GET /reviews/check/{product_id}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($uri[1]) && $uri[1] === 'check' && isset($uri[2])) {
    ReviewController::check($uri[2]);
    exit;
}

// GET /reviews/{product_id}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($uri[1])) {
    ReviewController::index($uri[1]);
    exit;
}

http_response_code(404);
