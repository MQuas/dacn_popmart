<?php

namespace app\controllers;

use app\core\Controller;

class ProfileController extends Controller
{
    public $profile_model;


    public function __construct()
    {
        $this->profile_model = $this->model('ProfileModel');
    }

        public function profileUser(){
            if ($this->profile_model !== null) {
                $orders = $this->profile_model->userOrder();
                foreach ($orders as &$order) {
                    $order['details'] = $this->profile_model->getOrderDetailByOrderId($order['id']);
                }
        
            $content = 'profile';
                $sub_content = [
                    'orders' => $orders
                ];
    
                $this->render('/layouts/client_home', [
                    'content' => $content,
                    'sub_content' => $sub_content
                ]);
        } 
}
}