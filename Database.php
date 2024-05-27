<?php
// Database.php
class Database {
    private static $pdo;

    public static function getConnection() {
        if (!self::$pdo) {
            $config = require 'Config.php';
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
            self::$pdo = new PDO($dsn, $config['user'], $config['password']);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}
?>
