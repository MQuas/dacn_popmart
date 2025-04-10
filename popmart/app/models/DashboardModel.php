<?php
namespace app\models;

use app\core\Model;

class DashboardModel extends Model {
public function getTotalProducts() {
    $sql = "SELECT COUNT(*) as total FROM products";
    $result = $this->getOne($sql);
    return $result ? $result['total'] : 0;
}

public function getCompletedOrders() {
    $sql = "SELECT COUNT(*) as total FROM orders WHERE status = 'Completed'";
    $result = $this->getOne($sql);
    return $result ? $result['total'] : 0;
}
public function getTotalCustomers() {
    $sql = "SELECT COUNT(*) as total FROM users WHERE role = 0";
    $result = $this->getOne($sql);
    return $result ? $result['total'] : 0;
}

public function getTotalRevenue() {
    $sql = "SELECT SUM(total_price) as total FROM orders WHERE status = 'Completed'";
    $result = $this->getOne($sql);
    return $result ? $result['total'] : 0;
}

}