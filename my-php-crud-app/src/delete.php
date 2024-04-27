<?php

require_once 'User.php';
require_once 'Database.php';

// Get the user ID from the request parameters
$id = $_GET['id'];

// Create a new instance of the User class
$user = new User();

// Delete the user with the specified ID
$user->delete($id);

// Redirect back to the read.php page
header('Location: read.php');
exit();