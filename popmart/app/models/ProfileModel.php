<?php

namespace app\models;

use app\core\Model;

class ProfileModel extends Model
{
    public function profileUser(){

    }

    public function userOrder(){
        $sql = "SELECT * FROM orders";
        return $this->getAll($sql);
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
}