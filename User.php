<?php
// User.php
require_once 'ORM.php';

class User extends ORM {
    protected static $table = 'users';
    protected static $primaryKey = 'id';

    public function getUsername() {
        return $this->attributes['username'];
    }

    public function setUsername($username) {
        $this->attributes['username'] = $username;
    }

    public function getEmail() {
        return $this->attributes['email'];
    }

    public function setEmail($email) {
        $this->attributes['email'] = $email;
    }

    public function getPassword() {
        return $this->attributes['password'];
    }

    public function setPassword($password) {
        $this->attributes['password'] = $password;
    }

    protected static function getCreateTableSQL() {
        return "CREATE TABLE IF NOT EXISTS " . self::$table . " (
            " . self::$primaryKey . " INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    }
}
?>
