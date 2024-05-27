<?php
// Include necessary files
require '../Config.php';
require '../Database.php';
require '../ORM.php';
require '../ORMInterface.php';
require '../User.php';

// Create a new user

echo "Creating a new user...<br>";
$user = new User();
$user->setUsername('reda');
$user->setEmail('chaa@example.com');
$user->setPassword('123');

if ($user->save()) {
    echo "User created <br>";
} else {
    echo "Failed to create user.<br>";
}
?>