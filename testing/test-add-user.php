<?php
// Include necessary files
require '../Config.php';
require '../Database.php';
require '../ORM.php';
require '../ORMInterface.php';
require '../User.php';
require '../Product.php';

// Create a new user

// echo "Creating a new user...<br>";
// $user = new User();
// $user->setUsername('reda');
// $user->setEmail('chaa@example.com');
// $user->setPassword('123');

// if ($user->save()) {
//     echo "User created <br>";
// } else {
//     echo "Failed to create user.<br>";
// }
echo "Creating a new user...<br>";
$Product = new Product ();
$Product->setName('reda');
$Product->setPrice('120');


if ($Product->save()) {
    echo " created <br>";
} else {
    echo "Failed to create .<br>";
}
?>