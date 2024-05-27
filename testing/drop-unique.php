<?php
// Include necessary files
require '../Config.php';
require '../Database.php';
require '../ORM.php';
require '../ORMInterface.php';
require '../User.php';

// Drop unique constraint
echo "Dropping unique constraint 'unique_username'...<br>";
if (User::dropConstraint('unique_username')) {
    echo "Unique constraint 'unique_username' dropped successfully.<br>";
} else {
    echo "Failed to drop unique constraint 'unique_username'.<br>";
}?>