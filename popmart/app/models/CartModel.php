<?php
namespace app\models;

use app\core\Model;

class CartModel extends Model {
    public function addCart($user_id, $pro_id, $variant_id, $quantity) {
        $sql = "INSERT INTO carts (user_id, pro_id, variant_id, quantity) VALUES (:user_id, :pro_id, :variant_id, :quantity)";
        return $this->insert($sql, [
            'user_id' => $user_id,
            'pro_id' => $pro_id,
            'variant_id' => $variant_id,
            'quantity' => $quantity
        ]);
    }

    public function cartUser($user_id) {
        $sql = "SELECT 
                    carts.id AS cart_id,
                    carts.user_id,
                    carts.quantity AS cart_quantity,
                    products.id AS product_id,
                    products.name AS product_name,
                    product_variants.id AS variant_id,
                    product_variants.variant_type AS variant_name,
                    product_variants.price_attri AS variant_price,
                    product_variants.quantity_per_variant,
                    (SELECT url_image FROM pro_images WHERE pro_id = carts.pro_id LIMIT 1) as url_img
                FROM carts 
                JOIN products ON carts.pro_id = products.id
                JOIN product_variants ON carts.variant_id = product_variants.id
                WHERE carts.user_id = :user_id";
        return $this->getAll($sql, ['user_id' => $user_id]);
    }
    public function getVariant($variant_id) {
       $sql = "SELECT id, variant_type, price_attri, stock 
               FROM product_variants 
               WHERE id = :variant_id";
       return $this->getOne($sql, ['variant_id' => $variant_id]);
   }
   
    public function checkCart($user_id, $pro_id, $variant_id) {
        $sql = "SELECT * FROM carts WHERE user_id = :user_id AND pro_id = :pro_id AND variant_id = :variant_id";
        return $this->getOne($sql, ['user_id' => $user_id, 'pro_id' => $pro_id, 'variant_id' => $variant_id]);
    }

    public function updateQuantityCart($new_quantity, $cart_id) {
        $sql = "UPDATE carts SET quantity = :quantity WHERE id = :cart_id";
        return $this->update($sql, ['quantity' => $new_quantity, 'cart_id' => $cart_id]);
    }

    public function getCartItem($cart_id) {
        $sql = "SELECT * FROM carts WHERE id = :cart_id";
        return $this->getOne($sql, ['cart_id' => $cart_id]);
    }

    public function getTotalPrice($user_id) {
        $sql = "SELECT SUM(carts.quantity * product_variants.price_attri) AS total_price
                FROM carts 
                JOIN product_variants ON carts.variant_id = product_variants.id
                WHERE carts.user_id = :user_id";
        return $this->getOne($sql, ['user_id' => $user_id]);
    }
}
?>
