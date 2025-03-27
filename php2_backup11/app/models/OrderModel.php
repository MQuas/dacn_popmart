<?php
namespace app\models;

use app\core\Model;

class OrderModel extends Model {
    public function getCartByUser($user_id) {
        $sql = "SELECT * FROM carts WHERE user_id = :user_id";
        return $this->query($sql, ['user_id' => $user_id])->fetchAll();
    }

    public function createOrder($user_id, $total_price, $code_order, $address, $payment_method, $payment_status) {
        $sql = "INSERT INTO `orders` (user_id, total_price, code_order, address, payment_method, payment_status) 
                VALUES (:user_id, :total_price, :code_order, :address, :payment_method, :payment_status)";
        return $this->insert($sql, [
            'user_id'     => $user_id, 
            'total_price' => $total_price,
            'code_order'  => $code_order,
            'address'     => $address,
            'payment_method'     => $payment_method,
            'payment_status'     => $payment_status

        ]);
    }
    

    public function createOrderDetail($order_id, $pro_id, $variant_name, $quantity, $price) {
        $sql = "INSERT INTO order_details (order_id, pro_id, variant_name, quantity, price) 
                VALUES (:order_id, :pro_id, :variant_name, :quantity, :price)";
        return $this->insert($sql, [
            'order_id' => $order_id,
            'pro_id' => $pro_id,
            'variant_name' => $variant_name,
            'quantity' => $quantity,
            'price' => $price
        ]);
    }    

    public function clearCart($user_id) {
        $sql = "DELETE FROM carts WHERE user_id = :user_id";
        $this->query($sql, ['user_id' => $user_id]);
    }
}
