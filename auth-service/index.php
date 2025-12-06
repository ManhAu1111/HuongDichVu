<?php
// 🔥 Thêm 3 dòng này để hiện lỗi PHP ra ngoài
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");
// header("Access-Control-Allow-Origin: http://127.0.0.1:8000");
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Xử lý preflight CORS (QUAN TRỌNG)
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');
$dotenv->load();

use App\Controllers\AuthController;

$auth = new AuthController();

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];

if ($uri === "/register" && $method === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($auth->register($data["fullname"], $data["email"], $data["password"]));
    exit;
}

if ($uri === "/login" && $method === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($auth->login($data["email"], $data["password"]));
    exit;
}

if ($uri === "/me" && $method === "GET") {
    $headers = getallheaders();

    if (!isset($headers["Authorization"])) {
        echo json_encode(["ok" => false, "message" => "Missing token"]);
        exit;
    }

    $token = str_replace("Bearer ", "", $headers["Authorization"]);

    try {
        $data = \App\Helpers\JWTHandler::decode($token);

        echo json_encode([
            "ok" => true,
            "data" => (array) $data
        ]);
    } catch (Exception $e) {
        echo json_encode([
            "ok" => false,
            "message" => "Invalid or expired token",
            "error" => $e->getMessage()
        ]);
    }
    exit;
}

if ($uri === "/verify" && $method === "GET") {
    if (!isset($_GET["token"])) {
        echo "Thiếu token!";
        exit;
    }

    $result = $auth->verify($_GET["token"]);

    if ($result["ok"]) {
        header("Location: http://127.0.0.1:8000/signin?verified=1");
    } else {
        echo $result["message"];
    }

    exit;
}

if ($uri === '/api/me' && $method === 'GET') {
    (new AuthController())->me();
}


echo json_encode(["status" => "Auth service running"]);
