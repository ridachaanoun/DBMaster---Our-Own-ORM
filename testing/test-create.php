<?php
// Include necessary files
require '../Config.php';
require '../Database.php';
require '../ORM.php';
require '../ORMInterface.php';
require '../User.php';



// Add columns to the User table
User::addUserColumn('username', 'VARCHAR(255) NOT NULL');
User::addUserColumn('email', 'VARCHAR(255) NOT NULL');
User::addUserColumn('password', 'VARCHAR(255) NOT NULL');
User::addUserColumn('created_at', 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP');


// Create the test table
echo "Creating User table...<br>";
if (User::setupTable("chaano")) {
    echo "User table created successfully.<br>";
} else {
    echo "Failed to create User table.<br>";
}



// // Create the test table
// $table->addUserColumn("age"," VARCHAR(255) NOT NULL" );
// echo "Creating User table...<br>";
// if ($table->setupTable("test")) {
//     echo "test table created successfully.<br>";
// } else {
//     echo "Failed to create test table.<br>";
// }
?>
