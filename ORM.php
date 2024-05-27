<?php
// ORM.php
require_once 'ORMInterface.php';
abstract class ORM implements ORMInterface {
    protected static $table;
    protected static $primaryKey = 'id';
    protected $attributes = [];

    public function __construct($attributes = []) {
        $this->attributes = $attributes;
    }

    public static function setupTable() {
        $pdo = Database::getConnection();
        $sql = static::getCreateTableSQL();
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
        $placeholders = array_map(function ($col) { return ":$col"; }, $columns);
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
        $placeholders = array_map(function ($col) { return "$col = :$col"; }, $columns);
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

    
    public static function addColumn($name, $type) {
        $pdo = Database::getConnection();
        $sql = "SHOW COLUMNS FROM " . static::$table . " LIKE '$name'";
        $stmt = $pdo->query($sql);
        $exists = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$exists) {
            $sql = "ALTER TABLE " . static::$table . " ADD COLUMN $name $type";
            return $pdo->exec($sql) !== false;
        }
        return !true; // Column already exists
    }

    public static function dropColumn($name) {
        $pdo = Database::getConnection();
        $sql = "ALTER TABLE " . static::$table . " DROP COLUMN $name";
        return $pdo->exec($sql) !== false;
    }

    public static function addUniqueConstraint($constraintName, $columns) {
        $pdo = Database::getConnection();
        $sql = "ALTER TABLE " . static::$table . " ADD CONSTRAINT $constraintName UNIQUE (" . implode(',', $columns) . ")";
        return $pdo->exec($sql) !== false;
    }

    public static function dropConstraint($constraintName) {
        $pdo = Database::getConnection();
        $sql = "ALTER TABLE " . static::$table . " DROP INDEX $constraintName";
        return $pdo->exec($sql) !== false;
    }

    abstract protected static function getCreateTableSQL();
}
?>
