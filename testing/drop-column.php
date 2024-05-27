<?php
// Include necessary files
require '../Config.php';
require '../Database.php';
require '../ORM.php';
require '../ORMInterface.php';
require '../User.php';

// Drop the column
echo "Dropping column 'age' from User table...<br>";
if (User::dropColumn('age')) {
    echo "Column 'age' dropped successfully.<br>";
} else {
    echo "Failed to drop column 'age'.<br>";
}
?>