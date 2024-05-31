<?php
// User.php
require_once 'ORM.php';

class User extends ORM {
    protected static $table = 'Users';
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
        $this->attributes['password'] = sha1($password) ;
    }
    public static function addUserColumn($name, $type) {
        static::$columns[$name] = $type;
    }

}
?>
