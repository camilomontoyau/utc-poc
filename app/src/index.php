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
    foreach ($users as $user) {
        echo "Name: {$user['name']}<br>";
        echo "created_at: {$user['created_at']}<br>";
        echo "updated_at: {$user['updated_at']}<br>";
        $createdAt = new DateTime($user['created_at'], new DateTimeZone('UTC'));
        $createdAt->setTimezone(new DateTimeZone('America/New_York'));
        echo "<script>const date = new Date('{$createdAt->format('Y-m-d H:i:s')}'); console.log(date);</script>";
        echo "<script>document.getElementById</script>";
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