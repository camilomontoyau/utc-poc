<?php

// Include necessary files
require_once 'User.php';
require_once 'Database.php';

// Create a new instance of the User class
$user = new User();

// Handle the routing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create a new user
    $user->setName($_POST['name']);
    $user->create();

    echo 'User created successfully!';
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "<a href='create.php'>Create User</a><br><br>";
    
    // Retrieve user data
    $users = $user->readAll();
    foreach ($users as $user_) {
        echo "Name: {$user_['name']}<br>";
        echo "created_at: {$user_['created_at']}<br>";
        echo "updated_at: {$user_['updated_at']}<br><br>";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Update user data
    parse_str(file_get_contents("php://input"), $data);
    $user = new User();
    $user = $user->read($data['id']);
    $user->setName($data['name']);
    $user->update();
    echo 'User updated successfully!';
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Delete a user
    parse_str(file_get_contents("php://input"), $data);
    $user->delete($data['id']);
    echo 'User deleted successfully!';
} else {
    echo 'Invalid request method!';
}
?>

<div id="app"></div>