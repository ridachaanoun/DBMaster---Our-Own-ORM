 <?php
// ORMInterface.php
if (!interface_exists('ORMInterface')) {
    interface ORMInterface {
        public static function setupTable();
        public function save();
        public static function find($id);
        public function delete();
    }
}
?> 
