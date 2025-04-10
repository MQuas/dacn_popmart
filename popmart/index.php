<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$link = str_replace('\\', '/', __DIR__);
define('_DIR_ROOT', $link);

// Xử lý http root
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
    $web_root = 'https://'.$_SERVER['HTTP_HOST'];
}else{
    $web_root = 'http://'.$_SERVER['HTTP_HOST'];
}
$web_root .= str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', strtolower(_DIR_ROOT));
define('_WEB_ROOT_', $web_root);

// Autoload
spl_autoload_register(function($class) {
    $file = _DIR_ROOT . "/" . str_replace('\\', '/', $class) . ".php";
    
    if (!file_exists($file)) {
        exit("Autoload Error - $file File Not Found");
    }

    require_once $file;
});
use app\core\exceptions\RouterException;
use app\core\Router as R;

try {
$router = new R();
//home client
$router->add("/", ["controller" => "product", "action" => "index"]);
$router->add("/series", ["controller" => "product", "action" => "all_product_series_and_cate"]);
$router->add('/product/detail/{id}', ['controller' => 'product', 'action' => 'product_detail']); 
//login
$router->add("/login", ["controller" => "user", "action" => "login"]);
$router->add("/logout", ["controller" => "user", "action" => "logout"]);
$router->add("/register", ["controller" => "user", "action" => "register"]);
$router->add("/verify", ["controller" => "user", "action" => "verify"]);
//cart
$router->add("/cart/add", ["controller" => "cart", "action" => "addCart"]);
$router->add("/cart", ["controller" => "cart", "action" => "showCart"]);
$router->add("/cart/update", ["controller" => "cart", "action" => "updateQuantity"]);
//search
$router->add("/product/search", ["controller" => "product", "action" => "all_product_series_and_cate"]);
//profile
$router->add("/profile/{id}", ["controller" => "profile", "action" => "profileUser"]);
//checkout
$router->add("/order/checkout", ["controller" => "order", "action" => "checkout"]);
$router->add("/order/success", ["controller" => "order", "action" => "success"]);
$router->add("/order/create", ["controller" => "order", "action" => "create_payment"]);
$router->add("/order/return", ["controller" => "order", "action" => "vnpay_return"]);
//admin
$router->add("/admin", ["controller" => "dashboard", "action" => "dashboard"]);
$router->add("/admin/search", ["controller" => "admin", "action" => "adminSearch"]);
//admin products
$router->add("/admin/product", ["controller" => "admin", "action" => "adminProduct"]);
$router->add("/admin/create", ["controller" => "admin", "action" => "insert_product"]);
$router->add("/admin/edit/{id}", ["controller" => "admin", "action" => "product_admin_by_id"]);
$router->add("/admin/update/{id}", ["controller" => "admin", "action" => "update_product_admin"]);
$router->add("/admin/delete/{id}", ["controller" => "admin", "action" => "delete_product_admin"]);
//users
$router->add("/admin/user", ["controller" => "admin", "action" => "adminUser"]);
$router->add("/admin/user/update/status", ["controller" => "admin", "action" => "updateUserStatus"]);
//orders
$router->add("/admin/order", ["controller" => "admin", "action" => "adminOrder"]);
$router->add("/admin/order/update/status", ["controller" => "admin", "action" => "updateOrderStatus"]);
$router->add("/admin/order/detail/{id}", ["controller" => "admin", "action" => "getOrderDetailByOrderId"]);
//admin category
$router->add("/admin/category", ["controller" => "admin", "action" => "adminCategory"]);
$router->add("/admin/category/add", ["controller" => "admin", "action" => "insert_category"]);
$router->add("/admin/category/edit/{id}", ["controller" => "admin", "action" => "adminCategoryById"]);
$router->add("/admin/category/update/{id}", ["controller" => "admin", "action" => "update_category_admin"]);
$router->add("/admin/category/delete/{id}", ["controller" => "admin", "action" => "delete_category_admin"]);








 // Lấy đường dẫn từ URL
 $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
 $basePath = dirname($_SERVER['SCRIPT_NAME']);
 if (strpos($path, $basePath) === 0) {
     $path = substr($path, strlen($basePath));
 }

 $params = $router->match($path);
 if ($params === false) {
     throw new RouterException("404 - Route Not Found!");
 }

 // Xác định controller và action
 $controllerClass = "app\\controllers\\" . ucfirst($params['controller']) . "Controller";
 $action = isset($params['action']) ? $params['action'] : "index";
 $id = isset($params['id']) ? $params['id'] : null;

 if (!class_exists($controllerClass)) {
     throw new Exception("Controller class not found: $controllerClass");
 }

 $controller_object = new $controllerClass();

 if (!method_exists($controller_object, $action)) {
     throw new Exception("Method $action not found in $controllerClass");
 }

 // Gọi action
 $controller_object->$action($id);
} catch (RouterException $e) {
 http_response_code(404);
 echo "Routing Error: " . $e->getMessage();
} catch (Exception $e) {
 http_response_code(500);
 echo "Application Error: " . $e->getMessage();
}