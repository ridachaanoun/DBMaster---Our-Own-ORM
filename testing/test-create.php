<?php
// Include necessary files
require '../Config.php';
require '../Database.php';
require '../ORM.php';
require '../ORMInterface.php';
require '../User.php';


// Create the User table
echo "Creating User table...<br>";
if (User::setupTable()) {
    echo "User table created successfully.<br>";
} else {
    echo "Failed to create User table.<br>";
}
?>
