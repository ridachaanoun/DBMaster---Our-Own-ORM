<?php
require_once 'ORMInterface.php';

abstract class ORM implements ORMInterface {
    protected static $table;
    protected static $primaryKey = 'id';
    protected $attributes = [];
    protected static $columns = [];

    public function __construct($attributes = []) {
        $this->attributes = $attributes;
    }

    public static function setupTable() {
        $pdo = Database::getConnection();
        $columns = static::$columns;
        $columns_str = "";

        foreach ($columns as $name => $type) {
            $columns_str .= "{$name} {$type}, ";
        }
        // Remove the trailing comma and space
        $columns_str = rtrim($columns_str, ", ");
        $sql = "CREATE TABLE IF NOT EXISTS " . static::$table . " (id INT AUTO_INCREMENT PRIMARY KEY, {$columns_str})";
        echo "Creating table with SQL: $sql<br>";

        return $pdo->exec($sql) !== false;
    }

    public function save() {
        if (isset($this->attributes[static::$primaryKey])) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    private function create() {
        $pdo = Database::getConnection();
        $columns = array_keys($this->attributes);
        $placeholders = [];

        foreach ($columns as $col) {
            $placeholders[] = ":$col";
        }
        $sql = "INSERT INTO " . static::$table . " (" . implode(',', $columns) . ") VALUES (" . implode(',', $placeholders) . ")";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute($this->attributes)) {
            $this->attributes[static::$primaryKey] = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    private function update() {
        $pdo = Database::getConnection();
        $columns = array_keys($this->attributes);
        $placeholders = [];

        foreach ($columns as $col) {
            $placeholders[] = "$col = :$col";
        }
        $sql = "UPDATE " . static::$table . " SET " . implode(',', $placeholders) . " WHERE " . static::$primaryKey . " = :" . static::$primaryKey;
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($this->attributes);
    }

    public static function find($id) {
        $pdo = Database::getConnection();
        $sql = "SELECT * FROM " . static::$table . " WHERE " . static::$primaryKey . " = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? new static($result) : null;
    }

    public function delete() {
        $pdo = Database::getConnection();
        $sql = "DELETE FROM " . static::$table . " WHERE " . static::$primaryKey . " = ?";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([$this->attributes[static::$primaryKey]]);
    }

    public static function addColumn($table, $name, $type) {
        $pdo = Database::getConnection();
        $sql = "SHOW COLUMNS FROM {$table} LIKE '{$name}'";
        $stmt = $pdo->query($sql);
        $exists = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$exists) {
            $sql = "ALTER TABLE {$table} ADD COLUMN {$name} {$type}";
            return $pdo->exec($sql) !== false;
        }
        return false; // Column already exists
    }

    public static function dropColumn($table, $name) {
        $pdo = Database::getConnection();
        $sql = "ALTER TABLE {$table} DROP COLUMN {$name}";
        return $pdo->exec($sql) !== false;
    }

    public static function addUniqueConstraint($table, $constraintName, $columns) {
        $pdo = Database::getConnection();
        $columns_str = implode(", ", $columns);
        $sql = "ALTER TABLE {$table} ADD CONSTRAINT {$constraintName} UNIQUE ({$columns_str})";
        return $pdo->exec($sql) !== false;
    }

    public static function dropConstraint($table, $constraintName) {
        $pdo = Database::getConnection();
        $sql = "ALTER TABLE {$table} DROP INDEX {$constraintName}";
        return $pdo->exec($sql) !== false;
    }
}
?>
