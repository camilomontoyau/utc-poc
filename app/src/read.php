<?php

require_once 'User.php';
require_once 'Database.php';

// Create a new instance of the User class
$user = new User();

// Connect to the database

// Retrieve all users
$users = $user->readAll();

// Display the user data
foreach ($users as $user) {
    echo "User ID: " . $user['id'] . "<br>";
    echo "Name: " . $user['name'] . "<br>";
    echo "Email: " . $user['email'] . "<br>";
    echo "<br>";
}
