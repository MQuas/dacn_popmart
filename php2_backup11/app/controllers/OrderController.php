<?php

namespace app\controllers;

use app\core\Controller;

class OrderController extends Controller
{
    public $order_model;
    public $cart_model;
    private $userModel;
    public function __construct()
    {
        $this->order_model = $this->model('OrderModel');
        $this->cart_model = $this->model('CartModel');
        $this->userModel = $this->model('UserModel');
    }

    public function checkout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user']['id'])) {
                header("Location: " . _WEB_ROOT_ . "/login");
                exit;
            }

            $user_id = $_SESSION['user']['id'];
            $cartItems = $this->cart_model->cartUser($user_id);

            if (empty($cartItems)) {
                header("Location: " . _WEB_ROOT_ . "/cart");
                exit;
            }
            $total_price = array_sum(array_map(function ($item) {
                return $item['variant_price'] * $item['cart_quantity'];
            }, $cartItems));

            $code_order = time();

            $user_info = $this->userModel->getUserById($user_id);
            $address = $user_info['address'] ?? '';
            if ($_POST['payment_method'] == 'COD') {
                $payment_method = 'COD';
                $payment_status = 'Chưa thanh toán';
                $order_id = $this->order_model->createOrder($user_id, $total_price, $code_order, $address, $payment_method, $payment_status);
                foreach ($cartItems as $item) {
                    $this->order_model->createOrderDetail(
                        $order_id,
                        $item['product_id'],
                        $item['variant_name'],
                        $item['cart_quantity'],
                        $item['variant_price']
                    );
                }
                $this->order_model->clearCart($user_id);
                $this->success($total_price);
            } else {
                $this->create_payment($total_price, $code_order);
            }
        }
    }


    public function create_payment($total_price, $code_order)
    {
        $vnp_TmnCode = "34E3COD6";
        $vnp_HashSecret = "3W14UGGWKN2G0JEZ7LTLVT1D3BL90D7S";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/php2_backup11/order/return";

        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_TxnRef = $code_order; //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $total_price; // Số tiền thanh toán
        // $vnp_Locale = $_POST['language']; //Ngôn ngữ chuyển hướng thanh toán
        // $vnp_BankCode = $_POST['bankCode']; //Mã phương thức thanh toán
        $vnp_OrderInfo = "Thanh toán đơn hàng #" .$code_order;
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_BankCode" => 'NCB'
        ];

        ksort($inputData);
        $query = http_build_query($inputData);
        $secureHash = hash_hmac("sha512", $query, $vnp_HashSecret);
        $vnp_PaymentUrl = $vnp_Url . "?" . $query . "&vnp_SecureHash=" . $secureHash;
        header("Location: $vnp_PaymentUrl");
        exit();
    }

    public function vnpay_return()
    {
        if($_GET['vnp_TransactionStatus'] == 00){

            $user_id = $_SESSION['user']['id'];
            $cartItems = $this->cart_model->cartUser($user_id);

            if (empty($cartItems)) {
                header("Location: " . _WEB_ROOT_ . "/cart");
                exit;
            }
            $total_price = array_sum(array_map(function ($item) {
                return $item['variant_price'] * $item['cart_quantity'];
            }, $cartItems));

            $address = $_POST['address'] ?? '';
            $code_order = $_GET['vnp_TxnRef'];
            $payment_method = $_GET['vnp_BankCode'];
            $payment_status = 'Đã thanh toán';

            $order_id = $this->order_model->createOrder($user_id, $total_price, $code_order, $address, $payment_method, $payment_status);
            foreach ($cartItems as $item) {
                $this->order_model->createOrderDetail(
                    $order_id,
                    $item['product_id'],
                    $item['variant_name'],
                    $item['cart_quantity'],
                    $item['variant_price']
                );
            }
            $this->order_model->clearCart($user_id);
           $this->success($total_price);
        }
    }
    
    public function success($total_price)
    {
        $content = 'succes_checkout';
        $sub_content = [
            'total_price' => $total_price
        ];
        $this->render('/layouts/client_home', [
            'content' => $content,
            'sub_content' => $sub_content
        ]);
    }
}
