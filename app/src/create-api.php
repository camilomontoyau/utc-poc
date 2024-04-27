<?php

require_once 'User.php';
require_once 'Database.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    
    $user = new User();

    // Set the user data
    $user->setName($name);

    // Create the user
    $user->create();
    
    
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
    <h1>Create User</h1>
    <form method="POST" action="create.php">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>
        <input type="submit" value="Create">
    </form>
</body>
</html>