<?php

require_once 'User.php';
require_once 'Database.php';

// Get the user ID from the request parameters
$id = $_GET['id'];

// Create a new instance of the User class
$user = new User();

// Get the user data from the database
$user = $user->read($id);

// Check if the user exists
if ($user !== null) {
    // Display the user data in a form for updating
    echo '<h1>Update User</h1>';
    echo '<form method="POST" action="update.php">';
    echo '<input type="hidden" name="id" value="' . $user->getId() . '">';
    echo 'Name: <input type="text" name="name" value="' . $user->getName() . '"><br>';
    echo '<input type="submit" value="Update">';
    echo '</form>';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the updated user data from the form
        $user->setName($_POST['name']);
        $user->update();

        // Redirect to the read.php page to view the updated user data
        header('Location: read.php');
        exit();
    }
} else {
    // Display an error message if the user does not exist
    echo 'User not found.';
}