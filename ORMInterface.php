 <?php
// ORMInterface.php
if (!interface_exists('ORMInterface')) {
    interface ORMInterface {
        public function save();
        public function delete();
        public static function find($id);
        public static function setupTable();
        public static function addColumn($table, $name, $type) ;
        public static function dropColumn($table, $name);
        public static function addUniqueConstraint($table, $constraintName, $columns);
        public static function dropConstraint($table, $constraintName) ;
    }
}
?> 
