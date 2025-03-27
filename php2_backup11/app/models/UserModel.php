<?php
namespace app\models;

use app\core\Model;

class UserModel extends Model {
    public function getUserById($user_id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        return $this->getOne($sql, [$user_id]);
    }
    
    public function checkEmailExists($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        return $this->getOne($sql, [$email]);
    }

    public function checkLogin($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $user = $this->getOne($sql, [$email]);
    
        if (!$user) {
            error_log("User not found: " . $email);
            return false;
        }
        if (!password_verify($password, $user["password"])) {
            error_log("Incorrect password for user: " . $email);
            return false;
        }
        return $user;
    }
    
    public function registerUser($email, $name, $password) {
        $sql = "INSERT INTO users (email, name, password) VALUES (?, ?, ?)";
        return $this->insert($sql, [$email, $name, $password]);
    }
}
?>
