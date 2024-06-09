<?php
require_once 'ORM.php';


class Product extends ORM {
    protected static $table = 'products';
    protected static $primaryKey = 'id';

    public function getName() {
        return $this->attributes['name'];
    }

    public function setName($name) {
        $this->attributes['name'] = $name;
    }

    public function getPrice() {
        return $this->attributes['price'];
    }

    public function setPrice($price) {
        $this->attributes['price'] = $price;
    }

    public static function addProductColumn($name, $type) {
        static::$columns[$name] = $type;
    }
}
?>