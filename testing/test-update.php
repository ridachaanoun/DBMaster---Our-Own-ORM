<?php
// Include necessary files
require '../Config.php';
require '../Database.php';
require '../ORM.php';
require '../ORMInterface.php';
require '../User.php';

// Update the user
echo "Updating user ...<br>";
$user = User::find(22);
if ($user) {
    $user->setUsername('updated-reda');
    $user->setEmail('updated@gmail.com');
    $user->setPassword('newpassword123');
    if ($user->save()) {
        echo "User updated successfully.<br>";
    } else {
        echo "Failed to update user.<br>";
    }
} else {
    echo "User not found.<br>";
}
?>