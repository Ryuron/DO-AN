<?php
session_start();
require_once 'app/helpers/SessionHelper.php';
require_once 'app/config/database.php'; // Kết nối DB

// Lấy URL
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Xác định tên controller
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'ProductController';

// Xác định action
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

// Tạo đường dẫn file controller
$controllerPath = 'app/controllers/' . $controllerName . '.php';

// Kiểm tra sự tồn tại controller
if (!file_exists($controllerPath)) {
    die("❌ Controller '$controllerName' không tồn tại.");
}

require_once $controllerPath;

// Khởi tạo controller
$controller = new $controllerName();

// Kiểm tra action tồn tại trong controller
if (!method_exists($controller, $action)) {
    die("❌ Action '$action' không tồn tại trong controller '$controllerName'.");
}

// Gọi action
call_user_func_array([$controller, $action], array_slice($url, 2));
