<?php

namespace app\models;

use app\core\Model;

class AdminModel extends Model
{

    public function get_all_product_admin()
    {
        $sql = "SELECT pro.id, pro.name, pro.cate_id, c.name as category_name, 
                       pro.price, pro.discount_percent, pro.sales,
                       (SELECT GROUP_CONCAT(pro_img.url_image ORDER BY pro_img.id ASC SEPARATOR ',') 
                        FROM pro_images pro_img WHERE pro_img.pro_id = pro.id) AS url_image,
                       (SELECT pro_img.show_images FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS show_images
                FROM products pro 
                LEFT JOIN categories c ON pro.cate_id = c.id
                WHERE pro.status = 0";

        $products = $this->getAll($sql);

        if ($products) {
            foreach ($products as &$product) {
                $sql_variants = "SELECT id, variant_type, quantity_per_variant, price_attri, stock 
                                 FROM product_variants 
                                 WHERE product_id = :id";
                $product['variants'] = $this->getAll($sql_variants, ['id' => $product['id']]);
            }
        }

        return $products;
    }


    public function insert_product($data)
    {
        $sql = "INSERT INTO products (name, cate_id, price, discount_percent, sales, status) 
                VALUES (:name, :cate_id, :price, :discount_percent, :sales, 0)";
        $product_id = $this->insert($sql, [
            'name' => $data['name'],
            'cate_id' => $data['cate_id'],
            'price' => $data['price'],
            'discount_percent' => $data['discount_percent'],
            'sales' => $data['sales']
        ]);
        if (!$product_id) {
            return false;
        }
        if (!empty($data['url_images'])) {
            foreach ($data['url_images'] as $url_image) {
                $sql_img = "INSERT INTO pro_images (pro_id, url_image) VALUES (:pro_id, :url_image)";
                $this->insert($sql_img, ['pro_id' => $product_id, 'url_image' => $url_image]);
            }
        }
        // if (!empty($data['show_images'])) {
        //     $sql_show_img = "INSERT INTO pro_images (pro_id, show_images) VALUES (:pro_id, :show_images)";
        //     $this->insert($sql_show_img, ['pro_id' => $product_id, 'show_images' => $data['show_images']]);
        // }

        if (!empty($data['variants'])) {
            foreach ($data['variants'] as $variant) {
                $sql_variant = "INSERT INTO product_variants (product_id, variant_type, quantity_per_variant, price_attri, stock) 
                                VALUES (:product_id, :variant_type, :quantity_per_variant, :price_attri, :stock)";
                $this->insert($sql_variant, [
                    'product_id' => $product_id,
                    'variant_type' => $variant['variant_type'],
                    'quantity_per_variant' => $variant['quantity_per_variant'],
                    'price_attri' => $variant['price_attri'],
                    'stock' => $variant['stock']
                ]);
            }
        }

        return $product_id;
    }

    public function get_product_admin_by_id($id)
    {
        $sql = "SELECT pro.id, pro.name, pro.cate_id, 
                       pro.price, pro.discount_percent, pro.sales,
                       (SELECT GROUP_CONCAT(pro_img.url_image ORDER BY pro_img.id ASC) 
                        FROM pro_images pro_img WHERE pro_img.pro_id = pro.id) AS url_image,
                       (SELECT pro_img.show_images FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS show_images
                FROM products pro 
                WHERE pro.id = :id 
                AND pro.status = 0";

        $product = $this->getOne($sql, ['id' => $id]);

        if ($product) {
            $sql_variants = "SELECT id, variant_type, quantity_per_variant, price_attri, stock 
                             FROM product_variants 
                             WHERE product_id = :id";
            $product['variants'] = $this->getAll($sql_variants, ['id' => $id]);
        }

        return $product;
    }

    public function update_product_admin($id, $data)
    {
        $sql = "UPDATE products SET 
                name = :name, 
                cate_id = :cate_id, 
                price = :price, 
                discount_percent = :discount_percent, 
                sales = :sales
            WHERE id = :id";

        $this->update($sql, [
            'id' => $id,
            'name' => $data['name'],
            'cate_id' => $data['cate_id'],
            'price' => $data['price'],
            'discount_percent' => $data['discount_percent'],
            'sales' => $data['sales']
        ]);

        if (!empty($data['url_images'])) {
            $sql_delete_images = "DELETE FROM pro_images WHERE pro_id = :id";
            $this->delete($sql_delete_images, ['id' => $id]);

            foreach ($data['url_images'] as $image_name) {
                $sql_img = "INSERT INTO pro_images (pro_id, url_image) VALUES (:pro_id, :url_image)";
                $this->insert($sql_img, ['pro_id' => $id, 'url_image' => $image_name]);
            }
        }

        $sql_delete_variants = "DELETE FROM product_variants WHERE product_id = :id";
        $this->delete($sql_delete_variants, ['id' => $id]);

        if (!empty($data['variants'])) {
            foreach ($data['variants'] as $variant) {
                $sql_variant = "INSERT INTO product_variants (product_id, variant_type, quantity_per_variant, price_attri, stock) 
                            VALUES (:product_id, :variant_type, :quantity_per_variant, :price_attri, :stock)";
                $this->insert($sql_variant, [
                    'product_id' => $id,
                    'variant_type' => $variant['variant_type'],
                    'quantity_per_variant' => $variant['quantity_per_variant'],
                    'price_attri' => $variant['price_attri'],
                    'stock' => $variant['stock']
                ]);
            }
        }

        return true;
    }
    public function get_old_images($id)
    {
        $sql = "SELECT url_image FROM pro_images WHERE pro_id = :id";
        return $this->getAll($sql, ['id' => $id]);
    }


    public function delete_product_admin($productId)
    {
        $this->deleteProductImages($productId);
        $this->deleteProductVariants($productId);

        $sql = "DELETE FROM products WHERE id = ?";
        return $this->query($sql, [$productId]);
    }


    // private function deleteProductImages($productId) {
    //     $sql = "DELETE FROM pro_images WHERE pro_id = ?";
    //     return $this->query($sql, [$productId]);
    // }

    private function deleteProductVariants($productId)
    {
        $sql = "DELETE FROM product_variants WHERE product_id = ?";
        return $this->query($sql, [$productId]);
    }
    private function deleteProductImages($productId)
    {
        $sql_select = "SELECT url_image FROM pro_images WHERE pro_id = ?";
        $images = $this->getAll($sql_select, [$productId]);

        if (!empty($images)) {
            foreach ($images as $image) {
                $filePath = _DIR_ROOT . "/app/assets/img/sanpham/" . $image['url_image'];
                // echo $filePath;
                // exit();
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
        $sql_delete = "DELETE FROM pro_images WHERE pro_id = ?";
        return $this->query($sql_delete, [$productId]);
    }

    //cate

    public function adminCategory()
    {
        $sql = "SELECT * FROM categories;";
        return $this->getAll($sql);
    }
    public function addCategory($data)
    {
        $sqlCheck = "SELECT COUNT(*) as total FROM categories WHERE name = :name";
        $result = $this->getOne($sqlCheck, ['name' => $data['name']]);

        if ($result && $result['total'] > 0) {
            return false;
        }
        $sqlInsert = "INSERT INTO categories (name) VALUES (:name)";
        return $this->insert($sqlInsert, ['name' => $data['name']]);
    }

    public function adminCategoryById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id ;";
        return $this->getAll($sql, ['id' => $id]);
    }

    public function updateCategory($data)
    {
        $sqlCheck = "SELECT COUNT(*) as total FROM categories WHERE name = :name AND id <> :id";
        $result = $this->getOne($sqlCheck, [
            'name' => $data['name'],
            'id'   => $data['id']
        ]);
        if ($result && $result['total'] > 0) {
            return false;
        }
        $sqlUpdate = "UPDATE categories SET name = :name WHERE id = :id";
        return $this->update($sqlUpdate, [
            'name' => $data['name'],
            'id'   => $data['id']
        ]);
    }
    public function deleteCategoryAdmin($id)
    {
        $sqlCheck = "SELECT COUNT(*) as total FROM products  WHERE cate_id = :id";
        $result =  $this->getOne($sqlCheck, ['id' => $id]);
        if ($result && $result['total'] > 0) {
            return false;
        }
        $sqlDelete = "DELETE FROM categories WHERE id = :id";
        return $this->query($sqlDelete, ['id' => $id]);
    }

    //order
    public function adminOrder(){
        $sql = "SELECT * FROM orders";
        return $this->getAll($sql);
    }

    public function getOrderById($orderId) {
        $sql = "SELECT id, status FROM orders WHERE id = :id";
        return $this->getOne($sql, ['id' => $orderId]);
    }

    public function updateOrderStatus($orderId, $newStatus) {
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        return $this->update($sql, ['status' => $newStatus, 'id' => $orderId]);
    }

    public function getOrderDetailByOrderId($order_id) {
        $sql = "SELECT od.*, 
                       p.name,
                       (SELECT pi.url_image FROM pro_images pi WHERE pi.pro_id = p.id LIMIT 1) as url_img
                FROM order_details od 
                JOIN products p ON od.pro_id = p.id 
                WHERE od.order_id = :order_id";
        return $this->getAll($sql, ['order_id' => $order_id]);
    }
    
    
    //user
    public function adminUser(){
        $sql = "SELECT * FROM users";
        return $this->getAll($sql);
    }
    public function updateUserStatus($user_id, $status) {
        $sql = "UPDATE users SET status = :status WHERE id = :user_id";
        return $this->update($sql, ['status' => $status, 'user_id' => $user_id]);
    }
    
//search
public function searchProducts($keyword) {
    $sql = "SELECT * FROM product WHERE name LIKE :keyword";
    $params = [':keyword' => '%' . $keyword . '%'];
    return $this->query($sql, $params);
}

}
