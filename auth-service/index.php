<?php

// ===============================================
// CORS CONFIG
// ===============================================
header("Access-Control-Allow-Origin: http://127.0.0.1:8000");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// PRE-FLIGHT REQUEST (Browser kiểm tra trước)
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}


// ===============================================
// AUTOLOAD + ENV
// ===============================================
require __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Controllers\AuthController;


// ===============================================
// ROUTE PARSING
// ===============================================
$auth   = new AuthController();
$uri    = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];

// Chuẩn hoá URI để tránh lỗi khi có dấu "/"
$uri = rtrim($uri, "/");


// ===============================================
// ROUTE MAPPING
// Hỗ trợ cả route cũ và route mới của FE
// ===============================================
$routes = [
    "/register"      => "register",
    "/auth/register" => "register",

    "/login"         => "login",
    "/auth/login"    => "login",

    "/me"            => "me",
    "/auth/me"       => "me",
];


// ===============================================
// CHECK ROUTE (POST /register, POST /login)
// ===============================================
if (isset($routes[$uri])) {

    $action = $routes[$uri];

    // ------------------------------
    // REGISTER
    // ------------------------------
    if ($action === "register" && $method === "POST") {

        $data = json_decode(file_get_contents("php://input"), true);

        echo json_encode(
            $auth->register(
                $data["fullname"] ?? "",
                $data["email"] ?? "",
                $data["password"] ?? ""
            ),
            JSON_UNESCAPED_UNICODE
        );
        exit;
    }


    // ------------------------------
    // LOGIN
    // ------------------------------
    if ($action === "login" && $method === "POST") {

        $data = json_decode(file_get_contents("php://input"), true);

        echo json_encode(
            $auth->login(
                $data["email"] ?? "",
                $data["password"] ?? ""
            ),
            JSON_UNESCAPED_UNICODE
        );
        exit;
    }


    // ------------------------------
    // GET USER (JWT)
    // ------------------------------
    if ($action === "me" && $method === "GET") {

        $headers = getallheaders();

        if (!isset($headers["Authorization"])) {
            echo json_encode(["ok" => false, "message" => "Missing token"]);
            exit;
        }

        $token = str_replace("Bearer ", "", $headers["Authorization"]);

        try {
            $data = \App\Helpers\JWTHandler::decode($token);
            echo json_encode(["ok" => true, "data" => (array) $data], JSON_UNESCAPED_UNICODE);

        } catch (Exception $e) {
            echo json_encode([
                "ok"      => false,
                "message" => "Invalid or expired token",
                "error"   => $e->getMessage()
            ], JSON_UNESCAPED_UNICODE);
        }

        exit;
    }
}


// ===============================================
// VERIFY EMAIL
// URL: /verify?token=...
// ===============================================
if ($uri === "/verify" && $method === "GET") {

    $token = $_GET["token"] ?? null;

    if (!$token) {
        echo "Thiếu token!";
        exit;
    }

    $result = $auth->verify($token);

    if ($result["ok"]) {
        header("Location: http://127.0.0.1:8000/signin?verified=1");
        exit;
    }

    echo $result["message"];
    exit;
}


// ===============================================
// DEFAULT RESPONSE
// ===============================================
echo json_encode([
    "status"   => "Auth service running",
    "endpoint" => $uri,
    "method"   => $method,
], JSON_UNESCAPED_UNICODE);

