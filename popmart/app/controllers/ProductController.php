<?php
namespace app\controllers;

use app\core\Controller;

class ProductController extends Controller {
    public $model_product;

    public function __construct() {
        $this->model_product = $this->model('ProductModel');
    }

    public function index() {
        if ($this->model_product !== null) {
            $new = $this->model_product->get_new_arrivals();
            $top = $this->model_product->get_top_sales();
            $content = 'home';
            $sub_content = [
                'new' => $new, // new
                'top' => $top  // top sell
            ];
    
            $this->render('/layouts/client_home', [
                'content' => $content,
                'sub_content' => $sub_content
            ]);
        } else {
            die('Error: Model not initialized.');
        }
    }
    public function all_product_series_and_cate() {
        if ($this->model_product !== null) {
            $keyword = $_GET['query'] ?? ''; 
            $keyword = trim($keyword);
    
            if (!empty($keyword)) {
                $series = $this->model_product->searchProducts($keyword);
            } else {
                $series = $this->model_product->get_all_series();
            }
    
            $cates = $this->model_product->allCate();
            $content = 'product';
            $sub_content = [
                'series' => $series,
                'cates' => $cates,
                'keyword' => $keyword
            ];
    
            $this->render('/layouts/client_home', [
                'content' => $content,
                'sub_content' => $sub_content
            ]);
        } else {
            die('Error: Model not initialized.');
        }
    }
    
    public function product_detail($id) {
        if ($this->model_product !== null) {
            $product = $this->model_product->get_product_by_id($id);
            if ($product) {
                $product['url_image'] = explode(',', $product['url_image']);
                $images = $product['url_image'];
                $variants = $product['variants'] ?? [];
    
                $content = 'product_detail';
                $sub_content = [
                    'product' => $product, 
                    'images' => $images,
                    'variants' => $variants
                ];
    
                $this->render('/layouts/client_home', [
                    'content' => $content,
                    'sub_content' => $sub_content
                ]);
            } else {
                die('Product not found');
            }
        } else {
            die('Error: Model not initialized.');
        }
    }
    public function protest($id) {
        if ($this->model_product !== null) {
            $product = $this->model_product->get_product_by_id($id);
            if ($product) {
                $product['url_image'] = explode(',', $product['url_image']);
                $images = $product['url_image'];
                $variants = $product['variants'] ?? [];
    
                $content = 'newPro';
                $sub_content = [
                    'product' => $product, 
                    'images' => $images,
                    'variants' => $variants
                ];
    
                $this->render('/layouts/client_home', [
                    'content' => $content,
                    'sub_content' => $sub_content
                ]);
            } else {
                die('Product not found');
            }
        } else {
            die('Error: Model not initialized.');
        }
    }
    
    


    
    

}
?>
