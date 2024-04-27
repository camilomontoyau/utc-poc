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
    // Retrieve user data
    $users = $user->readAll();
    foreach ($users as $user) {
        echo "Name: {$user['name']}<br>";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Update user data
    parse_str(file_get_contents("php://input"), $data);
    $user->update($data['id'], $data['name']);
    echo 'User updated successfully!';
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Delete a user
    parse_str(file_get_contents("php://input"), $data);
    $user->delete($data['id']);
    echo 'User deleted successfully!';
} else {
    echo 'Invalid request method!';
}