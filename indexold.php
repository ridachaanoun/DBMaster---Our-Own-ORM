<?php
// Include necessary files
require 'Config.php';
require 'Database.php';
require 'ORM.php';
require 'ORMInterface.php';
require 'User.php';

// Create the User table
echo "Creating User table...<br>";
if (User::setupTable()) {
    echo "User table created successfully.<br>";
} else {
    echo "Failed to create User table.<br>";
}

// Add a column to the User table
echo "Adding column 'age' to User table...<br>";
if (User::addColumn('age', 'INT')) {
    echo "Column 'age' added successfully.<br>";
} else {
    echo "Failed to add column 'age'.<br>";
}

// Create a new user

echo "Creating a new user...<br>";
$user = new User();
$user->setUsername('testuser');
$user->setEmail('test@example.com');
$user->setPassword('password123');

if ($user->save()) {
    echo "User created <br>";
} else {
    echo "Failed to create user.<br>";
}

// Read the user
echo "Reading user with ID 1...<br>";
$user = User::find(17);
if ($user) {
    echo "User found: " . $user->getUsername() . " - " . $user->getEmail() . "<br>";
} else {
    echo "User not found.<br>";
}

// Update the user
echo "Updating user with ID 1...<br>";
$user = User::find(17);
if ($user) {
    $user->setUsername('updateduser');
    $user->setEmail('updated@example.com');
    $user->setPassword('newpassword123');
    if ($user->save()) {
        echo "User updated successfully.<br>";
    } else {
        echo "Failed to update user.<br>";
    }
} else {
    echo "User not found.<br>";
}

// Delete the user
echo "Deleting user with ID 1...<br>";
$user = User::find(10);
if ($user) {
    if ($user->delete()) {
        echo "User deleted successfully.<br>";
    } else {
        echo "Failed to delete user.<br>";
    }
} else {
    echo "User not found.<br>";
}

// Drop the column
echo "Dropping column 'age' from User table...<br>";
if (User::dropColumn('age')) {
    echo "Column 'age' dropped successfully.<br>";
} else {
    echo "Failed to drop column 'age'.<br>";
}
// Add unique constraint
echo "Adding unique constraint on 'username'...<br>";
if (User::addUniqueConstraint('unique_username', ['username'])) {
    echo "Unique constraint on 'username' added successfully.<br>";
} else {
    echo "Failed to add unique constraint on 'username'.<br>";
}

// Drop unique constraint
echo "Dropping unique constraint 'unique_username'...<br>";
if (User::dropConstraint('unique_username')) {
    echo "Unique constraint 'unique_username' dropped successfully.<br>";
} else {
    echo "Failed to drop unique constraint 'unique_username'.<br>";
}
