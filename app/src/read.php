<?php

require_once 'User.php';
require_once 'Database.php';

// Create a new instance of the User class
$user = new User();

// Connect to the database
$database = new Database();
$connection = $database->connect();

// Retrieve all users
$users = $user->getAllUsers($connection);

// Display the user data
foreach ($users as $user) {
    echo "User ID: " . $user['id'] . "<br>";
    echo "Name: " . $user['name'] . "<br>";
    echo "Email: " . $user['email'] . "<br>";
    echo "<br>";
}

// Close the database connection
$database->closeConnection();

?>