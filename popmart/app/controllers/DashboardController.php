<?php

namespace app\controllers;

use app\core\Controller;

class DashboardController extends Controller
{
    public $dashboard_admin;

    public function __construct()
    {
        $this->dashboard_admin = $this->model('DashboardModel');
    }

    public function dashboard()
    {
        $totalProducts    = $this->dashboard_admin->getTotalProducts();
        $completedOrders  = $this->dashboard_admin->getCompletedOrders();
        $totalCustomers   = $this->dashboard_admin->getTotalCustomers();
        $totalRevenue     = $this->dashboard_admin->getTotalRevenue();

        $content = 'ad_home';
        $sub_content = [
            'totalProducts'   => $totalProducts,
            'completedOrders' => $completedOrders,
            'totalCustomers'  => $totalCustomers,
            'totalRevenue'    => $totalRevenue
        ];
        $this->render('/layouts/admin_home', [
            'content' => $content,
            'sub_content' => $sub_content
        ]);
    }
}
