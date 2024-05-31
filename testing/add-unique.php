<?php
// Include necessary files
require '../Config.php';
require '../Database.php';
require '../ORM.php';
require '../ORMInterface.php';
require '../User.php';

// Add unique constraint
echo "Adding unique constraint on 'username'...<br>";
if (User::addUniqueConstraint('users', 'unique_username', ['username'])) {
    echo "Unique constraint on 'username' added successfully.<br>";
} else {
    echo "Failed to add unique constraint on 'username'.<br>";
}
?>
