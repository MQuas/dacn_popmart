<?php

namespace app\controllers;

use app\core\Controller;

class AdminController extends Controller
{
    public $admin_model;
    public $new_model;
    public $model_product;


    public function __construct()
    {
        $this->admin_model = $this->model('AdminModel');
        $this->model_product = $this->model('ProductModel');
    }
    public function index()
    {
        $content = 'ad_home';
        $sub_content = [];
        $this->render("/layouts/admin_home", [
            "content" => $content,
            "sub_content" => $sub_content
        ]);
    }
    public function adminProduct()
    {
        if ($this->model_product !== null) {
            $products = $this->admin_model->get_all_product_admin();
            $cates = $this->model_product->allCate();
            if ($products) {
                $variants = $product['variants'] ?? [];

                $content = 'ad_product';
                $sub_content = [
                    'products' => $products,
                    'variants' => $variants,
                    'cates' => $cates
                ];

                $this->render('/layouts/admin_home', [
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

    public function insert_product()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [];
            $data['name']             = $_POST['name'] ?? '';
            $data['cate_id']          = $_POST['cate_id'] ?? 0;
            $data['price']            = $_POST['price'] ?? 0;
            $data['discount_percent'] = $_POST['discount_percent'] ?? 0;
            $data['sales']            = $_POST['sales'] ?? 0;
            $data['url_images'] = [];
            if (isset($_FILES['url_images']) && $_FILES['url_images']['error'][0] == 0) {
                foreach ($_FILES['url_images']['tmp_name'] as $key => $tmpName) {
                    $fileName = uniqid() . '_' . $_FILES['url_images']['name'][$key];
                    $uploadPath = __DIR__ . "/../assets/img/sanpham/" . $fileName;
                    if (move_uploaded_file($tmpName, $uploadPath)) {
                        $data['url_images'][] = $fileName;
                    }
                }
            }
            // if (isset($_FILES['show_images']) && $_FILES['show_images']['error'] == 0) {
            //     $fileName = uniqid() . '_' . $_FILES['show_images']['name'];
            //     $uploadPath = __DIR__ . "/../assets/img/sanpham/show/" . $fileName;
            //     if (move_uploaded_file($_FILES['show_images']['tmp_name'], $uploadPath)) {
            //         $data['show_images'] = $fileName;
            //     }
            // }
            $data['variants'] = $_POST['variants'] ?? [];
            $product_id = $this->admin_model->insert_product($data);
            if ($product_id) {
                header("Location: " . _WEB_ROOT_ . "/admin/product");
                exit();
            } else {
                die('Thêm sản phẩm thất bại');
            }
        }
    }
    public function product_admin_by_id($id)
    {
        if ($this->admin_model !== null) {
            $product = $this->admin_model->get_product_admin_by_id($id);
            $cates = $this->model_product->allCate();
            if ($product) {
                $product['url_image'] = explode(',', $product['url_image']);
                $images = $product['url_image'];
                $variants = $product['variants'] ?? [];
                $content = 'ad_edit_product';
                $sub_content = [
                    'product' => $product,
                    'images' => $images,
                    'variants' => $variants,
                    'cates' => $cates
                ];

                $this->render('/layouts/admin_home', [
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


    public function update_product_admin()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                $_SESSION['error'] = "Sản phẩm không hợp lệ.";
                header("Location: " . _WEB_ROOT_ . "/admin/product");
                exit;
            }

            $data = [
                'name' => $_POST['name'] ?? '',
                'cate_id' => $_POST['cate_id'] ?? 0,
                'price' => $_POST['price'] ?? 0,
                'discount_percent' => $_POST['discount_percent'] ?? 0,
                'sales' => $_POST['sales'] ?? 0,
                'variants' => $_POST['variants'] ?? [],
                'url_images' => []
            ];

            $upload_dir = "app/assets/img/sanpham/";

            if (!empty($_FILES['url_images']['name'][0])) {
                $old_images = $this->admin_model->get_old_images($id);

                if (!empty($old_images)) {
                    foreach ($old_images as $old) {
                        $old_path = $upload_dir . $old['url_image'];
                        if (file_exists($old_path)) {
                            unlink($old_path);
                        }
                    }
                }

                $uploaded_images = [];
                foreach ($_FILES['url_images']['tmp_name'] as $key => $tmp_name) {
                    $file_name = basename($_FILES['url_images']['name'][$key]);
                    $target_path = $upload_dir . $file_name;

                    if (move_uploaded_file($tmp_name, $target_path)) {
                        $uploaded_images[] = $file_name;
                    }
                }
                if (!empty($uploaded_images)) {
                    $data['url_images'] = $uploaded_images;
                }
            }
            $result = $this->admin_model->update_product_admin($id, $data);
            if ($result) {
                header("Location: " . _WEB_ROOT_ . "/admin/product");
                exit;
            }
        }
    }

    public function delete_product_admin($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($this->admin_model->delete_product_admin($id)) {
                $_SESSION["success"] = "Xóa sản phẩm thành công!";
            } else {
                $_SESSION["error"] = "Xóa sản phẩm thất bại!";
            }
            header("Location: " . _WEB_ROOT_ . "/admin/product");
            exit;
        }
    }

    // cate
    public function adminCategory()
    {
        if ($this->model_product !== null) {
            $cates = $this->admin_model->adminCategory();
            if ($cates) {
                $content = 'ad_category';
                $sub_content = [
                    'cates' => $cates,
                ];

                $this->render('/layouts/admin_home', [
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

    public function insert_category()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [];

            $data['name'] = trim($_POST['name'] ?? '');
            $category_id = $this->admin_model->addCategory($data);

            if ($category_id) {
                header("Location: " . _WEB_ROOT_ . "/admin/category");
                exit();
            } else {
                $_SESSION['error'] = 'Danh mục đã tồn tại!';
                header("Location: " . _WEB_ROOT_ . "/admin/category");
                exit();
            }
        }
        $errors = $_SESSION['error'];
        $content = 'ad_category';
        $sub_content = [
            'errors' => $errors,
        ];
        $this->render('/layouts/admin_home', [
            'content' => $content,
            'sub_content' => $sub_content
        ]);
    }
    public function adminCategoryById($id)
    {
        if ($this->admin_model !== null) {
            $cate = $this->admin_model->adminCategoryById($id);
            $content = 'ad_edit_category';
            $sub_content = [
                'cate' => $cate
            ];
            $this->render('/layouts/admin_home', [
                'content' => $content,
                'sub_content' => $sub_content
            ]);
        }
    }


    public function update_category_admin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [];
            $data['id'] = $_POST['id'] ?? '';
            $data['name'] = trim($_POST['name'] ?? '');

            $updated = $this->admin_model->updateCategory($data);
            if ($updated) {
                header("Location: " . _WEB_ROOT_ . "/admin/category");
                exit();
            } else {
                $_SESSION['error'] = "Tên danh mục đã tồn tại hoặc cập nhật thất bại.";
                header("Location: " . _WEB_ROOT_ . "/admin/category");
                exit();
            }
        }
    }
    public function delete_category_admin($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deleted = $this->admin_model->deleteCategoryAdmin($id);
            if ($deleted) {
                header("Location: " . _WEB_ROOT_ . "/admin/category");
                exit();
            } else {
                $_SESSION['error'] = 'Không Thể Xóa Danh Mục Có Sản Phẩm !';
                header("Location: " . _WEB_ROOT_ . "/admin/category");
                exit();
            }
        }
        $errors = $_SESSION['error'];
        $content = 'ad_category';
        $sub_content = [
            'errors' => $errors,

        ];
        $this->render('/layouts/admin_home', [
            'content' => $content,
            'sub_content' => $sub_content
        ]);
    }
    //order

    public function adminOrder()
    {
        if ($this->admin_model !== null) {
            $orders = $this->admin_model->adminOrder();
            foreach ($orders as &$order) {
                $order['details'] = $this->admin_model->getOrderDetailByOrderId($order['id']);
            }
            $content = 'ad_order';
            $sub_content = [
                'orders' => $orders
            ];
            $this->render('/layouts/admin_home', [
                'content' => $content,
                'sub_content' => $sub_content
            ]);
        }
    }



    public function updateOrderStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . _WEB_ROOT_ . "/admin/order");
            exit;
        }

        $orderId   = $_POST['id'] ?? null;
        $newStatus = $_POST['status'] ?? null;
        $validStatus = ['Pending', 'Processing', 'Shipped', 'Completed', 'Canceled'];

        if (!$orderId || !in_array($newStatus, $validStatus)) {
            $_SESSION['error'] = "Dữ liệu không hợp lệ";
            header("Location: " . _WEB_ROOT_ . "/admin/order");
            exit;
        }

        $order = $this->admin_model->getOrderById($orderId);
        if (!$order) {
            $_SESSION['error'] = "Không tìm thấy đơn hàng";
            header("Location: " . _WEB_ROOT_ . "/admin/order");
            exit;
        }

        if ($order['status'] === 'Completed') {
            $_SESSION['error'] = "Đơn hàng đã hoàn thành, không thể cập nhật";
            header("Location: " . _WEB_ROOT_ . "/admin/order");
            exit;
        }
        $statusOrder = [
            'Pending'    => 1,
            'Processing' => 2,
            'Shipped'    => 3,
            'Completed'  => 4,
            'Canceled'   => 5
        ];

        // no roll back
        // moi > cu => erorr
        if ($statusOrder[$newStatus] < $statusOrder[$order['status']]) {
            $_SESSION['error'] = "Không thể chuyển trạng thái từ {$order['status']} về {$newStatus}";
            header("Location: " . _WEB_ROOT_ . "/admin/order");
            exit;
        }

        $updateSuccess = $this->admin_model->updateOrderStatus($orderId, $newStatus);
        if (!$updateSuccess) {
            $_SESSION['error'] = "Cập nhật thất bại";
            header("Location: " . _WEB_ROOT_ . "/admin/order");
            exit;
        }

        $_SESSION['success'] = "Cập nhật trạng thái đơn hàng thành công";
        header("Location: " . _WEB_ROOT_ . "/admin/order");
        exit;
    }

    //user
    public function adminUser()
    {
        if ($this->admin_model !== null) {
            $users = $this->admin_model->adminUser();
            $content = 'ad_user';
            $sub_content = [
                'users' => $users
            ];
            $this->render('/layouts/admin_home', [
                'content' => $content,
                'sub_content' => $sub_content
            ]);
        }
    }

    public function updateUserStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . _WEB_ROOT_ . "/admin/user");
            exit;
        }
        $user_id = $_POST['id'] ?? null;
        $status  = $_POST['status'] ?? null;
        $validStatuses = ['active', 'block'];

        if (!$user_id || !in_array($status, $validStatuses)) {
            $_SESSION['error'] = "Dữ liệu không hợp lệ";
            header("Location: " . _WEB_ROOT_ . "/admin/user");
            exit;
        }

        $updateSuccess = $this->admin_model->updateUserStatus($user_id, $status);

        if ($updateSuccess) {
            $_SESSION['success'] = "Cập nhật trạng thái thành công";
        } else {
            $_SESSION['error'] = "Cập nhật thất bại";
        }

        header("Location: " . _WEB_ROOT_ . "/admin/user");
        exit;
    }

    //search
    public function adminSearch() {
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $products = $this->admin_model->searchProducts($keyword);

        $this->render('/layouts/admin_home', ['products' => $products]);
    }
}
