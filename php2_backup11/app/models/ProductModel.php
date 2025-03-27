<?php

namespace app\models;

use app\core\Model;

require_once "./app/core/Model.php";

class ProductModel extends Model
{
    public function get_all_series()
    {
        $sql = "SELECT pro.id, pro.name, pro.cate_id, ";
        $sql .= "pro.price, pro.discount_percent, pro.sales, ";
        $sql .= "(SELECT pro_img.url_image FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS url_image, ";
        $sql .= "(SELECT pro_img.show_images FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS show_images ";
        $sql .= "FROM products pro ";
        $sql .= "WHERE 1 ";
        $sql .= "AND pro.status = 0 ";
        $sql .= "ORDER BY pro.id ASC ";
        return $this->getAll($sql);
    }
    public function get_new_arrivals()
    {
        $sql = "SELECT pro.id, pro.name, pro.cate_id, ";
        $sql .= "pro.price, pro.discount_percent, pro.sales, ";
        $sql .= "(SELECT pro_img.url_image FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS url_image, ";
        $sql .= "(SELECT pro_img.show_images FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS show_images ";
        $sql .= "FROM products pro ";
        $sql .= "WHERE 1 ";
        $sql .= "AND pro.status = 0 ";
        $sql .= "ORDER BY pro.id ASC ";
        $sql .= "LIMIT 4";
        return $this->getAll($sql);
    }

    public function get_top_sales()
    {
        $sql = "SELECT pro.id, pro.name, pro.cate_id, ";
        $sql .= "pro.price, pro.discount_percent, pro.sales, ";
        $sql .= "(SELECT pro_img.url_image FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS url_image, ";
        $sql .= "(SELECT pro_img.show_images FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS show_images ";
        $sql .= "FROM products pro ";
        $sql .= "WHERE 1 ";
        $sql .= "AND pro.status = 0 ";
        $sql .= "ORDER BY pro.sales DESC ";
        $sql .= "LIMIT 16";
        return $this->getAll($sql);
    }

    public function get_product_by_id($id) {
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
    

    public function allCate()
    {
        $sql = "SELECT * FROM categories;";
        return $this->getAll($sql);
    }
    public function searchProducts($keyword)
    {
        $sql = "SELECT pro.id, pro.name, pro.cate_id, 
                       pro.price, pro.discount_percent, pro.sales,
                       (SELECT pro_img.url_image FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS url_image,
                       (SELECT pro_img.show_images FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS show_images
                FROM products pro
                WHERE pro.name LIKE :keyword
                AND pro.status = 0";
        return $this->getAll($sql, ['keyword' => "%$keyword%"]);
    }
}
