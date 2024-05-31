<?php
// Include necessary files
require '../Config.php';
require '../Database.php';
require '../ORM.php';
require '../ORMInterface.php';
require '../User.php';


// Add a column to the User table
echo "Adding column 'age' to User table...<br>";
if (User::addColumn('rida', 'age', 'INT')) {
    echo "Column 'age' added successfully.<br>";
} else {
    echo "Failed to add column 'age'.<br>";
}
?>