<?php
namespace app\core;
class Controller {
    public function model($model) {
        $modelClass = "app\\models\\$model";
        if (class_exists($modelClass)) {
            return new $modelClass();
        } else {
            die("Error: Model class '$modelClass' does not exist.");
        }
    }

    // render view
    public function render($view, $data = []) {
        extract($data);
        $viewPath = _DIR_ROOT . '/app/views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("Error: View '$viewPath' does not exist.");
        }
    }
    
}
