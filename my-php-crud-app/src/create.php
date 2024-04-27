<?php

require_once 'User.php';
require_once 'Database.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create a new User instance
    $user = new User();

    // Set the user data
    $user->setName($name);
    $user->setEmail($email);
    $user->setPassword($password);

    // Save the user to the database
    $database = new Database(
      "localhost",
      "test",
      "test",
      "test"
    );
    $database->connect();
    $database->createUser($user);
    $database->disconnect();

    // Redirect to the index page
    header('Location: index.php');
    exit;
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
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" value="Create">
    </form>
</body>
</html>