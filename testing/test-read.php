<?php
// Include necessary files
require '../Config.php';
require '../Database.php';
require '../ORM.php';
require '../ORMInterface.php';
require '../User.php';

// Read the user
echo "Reading user ...<br>";
$user = User::find(27);
if ($user) {
    echo "User found: " . $user->getUsername() . " - " . $user->getEmail() . "<br>";
} else {
    echo "User not found.<br>";
}
?>