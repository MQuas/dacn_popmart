<?php

namespace app\controllers;

use app\core\Controller;

class CartController extends Controller
{
    public $cart_model;
    private $Usermodel;

    public function __construct()
    {
        $this->cart_model = $this->model('CartModel');
        $this->Usermodel = $this->model('UserModel');
    }

    public function addCart()
    {
        $pro_id = $_POST['pro_id'] ?? null;
        if (!isset($_SESSION['user']['id'])) {
            $_SESSION['error_message'] = "Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!";
            header("Location: " . _WEB_ROOT_ . "/product/detail/" . $pro_id);
            exit();
        }

        $user_id = $_SESSION['user']['id'];
        $pro_id = $_POST['pro_id'] ?? null;
        $variant_id = $_POST['variant_id'] ?? null;
        $quantity = $_POST['quantity'] ?? 1;

        if (!$pro_id || !$variant_id) {
            $_SESSION['error_message'] = "Lỗi: Không xác định được sản phẩm hoặc biến thể!";
            header("Location: " . _WEB_ROOT_ . "/cart");
            exit();
        }


        $variant = $this->cart_model->getVariant($variant_id);
        if (!$variant) {
            $_SESSION['error_message'] = "Lỗi: Không tìm thấy biến thể sản phẩm!";
            header("Location: " . _WEB_ROOT_ . "/cart");
            exit();
        }


        if ($variant['stock'] < $quantity) {
            $_SESSION['error_message'] = "Lỗi: Số lượng trong kho không đủ!";
            header("Location: " . _WEB_ROOT_ . "/product/detail/" . $pro_id);
            exit();
        }


        $cartItem = $this->cart_model->checkCart($user_id, $pro_id, $variant_id);
        if ($cartItem) {
            $new_quantity = $cartItem['quantity'] + $quantity;


            if ($new_quantity > $variant['stock']) {
                $_SESSION['error_message'] = "Lỗi: Số lượng đặt hàng vượt quá tồn kho!";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }

            $result = $this->cart_model->updateQuantityCart($new_quantity, $cartItem['id']);
        } else {
            $result = $this->cart_model->addCart($user_id, $pro_id, $variant_id, $quantity);
        }

        $_SESSION[$result ? 'success_message' : 'error_message'] =
            $result ? "✅ Sản phẩm đã được thêm vào giỏ hàng!" : "❌ Lỗi khi thêm sản phẩm!";

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    public function updateQuantity()
    {
        $cart_id = $_POST['cart_id'] ?? null;
        $action = $_POST['action'] ?? null;

        if (!$cart_id) {
            $_SESSION['error_message'] = "Lỗi: Không thể cập nhật số lượng!";
            header("Location: " . _WEB_ROOT_ . "/cart");
            exit();
        }

        $cartItem = $this->cart_model->getCartItem($cart_id);
        if (!$cartItem) {
            $_SESSION['error_message'] = "Lỗi: Giỏ hàng không tồn tại!";
            header("Location: " . _WEB_ROOT_ . "/cart");
            exit();
        }

        $variant = $this->cart_model->getVariant($cartItem['variant_id']);
        if (!$variant) {
            $_SESSION['error_message'] = "Lỗi: Không tìm thấy biến thể sản phẩm!";
            header("Location: " . _WEB_ROOT_ . "/cart");
            exit();
        }


        $new_quantity = $cartItem['quantity'];
        if ($action === "increase" && $new_quantity < $variant['stock']) {
            $new_quantity++;
        } elseif ($action === "decrease" && $new_quantity > 1) {
            $new_quantity--;
        } else {
            $_SESSION['error_message'] = "Lỗi: Không thể cập nhật số lượng!";
            header("Location: " . _WEB_ROOT_ . "/cart");
            exit();
        }

        $result = $this->cart_model->updateQuantityCart($new_quantity, $cart_id);

        $_SESSION[$result ? 'success_message' : 'error_message'] =
            $result ? "Cập nhật số lượng thành công!" : "Lỗi khi cập nhật số lượng!";

        header("Location: " . _WEB_ROOT_ . "/cart");
        exit();
    }

    public function showCart()
    {
        if (!isset($_SESSION['user']['id'])) {
            $_SESSION['error_message'] = "Bạn cần đăng nhập để xem giỏ hàng!";
            header("Location: " . _WEB_ROOT_ . "/login");
            exit();
        }

        $user_id = $_SESSION['user']['id'];
        $cartusers = $this->cart_model->cartUser($user_id);
        $totalPrice = $this->cart_model->getTotalPrice($user_id);
        $user_info = $this->Usermodel->getUserById($user_id);
        $address = $user_info['address'] ?? 'Chưa có địa chỉ';

        foreach ($cartusers as &$cartuser) {
            if ($cartuser['variant_name'] === 'single_box') {
                $cartuser['variant_display'] = "Single Box";
            } elseif ($cartuser['variant_name'] === 'box') {
                $cartuser['variant_display'] = "Box";
            } else {
                $cartuser['variant_display'] = "N/A";
            }
        }

        $content = 'cart';
        $sub_content = [
            'cartusers' => $cartusers,
            'total_price' => $totalPrice['total_price'] ?? 0,
            'address' => $address
        ];
        $this->render("/layouts/client_home", [
            "content" => $content,
            "sub_content" => $sub_content
        ]);
    }
}
