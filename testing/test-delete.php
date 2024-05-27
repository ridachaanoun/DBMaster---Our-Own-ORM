<?php
// Include necessary files
require '../Config.php';
require '../Database.php';
require '../ORM.php';
require '../ORMInterface.php';
require '../User.php';

// Delete the user
echo "Deleting user ...<br>";
$user = User::find(17);
if ($user) {
    if ($user->delete()) {
        echo "User deleted successfully.<br>";
    } else {
        echo "Failed to delete user.<br>";
    }
} else {
    echo "User not found.<br>";
}
?>