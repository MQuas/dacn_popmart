<?php
namespace app\controllers;

use app\core\Controller;

class UserController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    public function verify() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';

            if ($this->userModel->checkEmailExists($email)) {
                header("Location: login");
                exit;
            } else {
                header("Location: register");
                exit;
            }
        }
        $this->render("/layouts/client_home", [
            "content" => "verify",
            "sub_content" => []
        ]);
    }
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"] ?? "";
            $password = $_POST["password"] ?? "";
    
            $user = $this->userModel->checkLogin($email, $password);
            if ($user) {
                if (isset($user["status"]) && $user["status"] === "block") {
                    $_SESSION['error_message'] = "Tài khoản của bạn đã bị khóa";
                    header("Location: " . _WEB_ROOT_ . "/login");
                    exit;
                } else {
                    $_SESSION["user"] = [
                        "id"    => $user["id"],
                        "email" => $user["email"],
                        "name"  => $user["name"],
                        "role"  => $user["role"]
                    ];
                    if ($user["role"] == 2) {
                        header("Location: " . _WEB_ROOT_ . "/admin");
                    } else {
                        header("Location: " . _WEB_ROOT_);
                    }
                    exit;
                }
            } else {
                $_SESSION['error_message'] = "Email hoặc mật khẩu không đúng!";
                header("Location: " . _WEB_ROOT_ . "/login");
                exit;
            }
        }
        
        $layout = (isset($_SESSION['user']) && $_SESSION['user']['role'] == 2) 
                    ? "/layouts/admin_home" 
                    : "/layouts/client_home";
    
        $this->render($layout, [
            "content" => "login",
            "sub_content" => [
                "error" => $_SESSION['error_message'] ?? "",
                "email" => $_POST["email"] ?? ""
            ]
        ]);
    }
    
    
    
    

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"] ?? "";
            $name = $_POST["name"] ?? "";
            $password = $_POST["password"] ?? "";
            if ($this->userModel->checkEmailExists($email)) {
                $error = "Email đã tồn tại!";
            } else {
                //ma hoa
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                // luu vao database
                $registerSuccess = $this->userModel->registerUser($email, $name, $hashedPassword);
                if ($registerSuccess) {
                    $_SESSION["user"] = [
                        "email" => $email,
                        "name" => $name,
                        "role" => 0
                    ];
                    header("Location: " . _WEB_ROOT_ . "/login"); 
                    exit;
                } else {
                    $error = "Có lỗi xảy ra, vui lòng thử lại!";
                }
            }
        }
        $this->render("/layouts/client_home", [
            "content" => "register",
            "sub_content" => [
                "error" => $error ?? "",
                "email" => $_POST["email"] ?? "",
                "name" => $_POST["name"] ?? ""
            ]
        ]);
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: " . _WEB_ROOT_ . "/login"); 
        exit;
    }
    
    
    
    
  
    
    

}
?>
