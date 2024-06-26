<?php

require_once 'User.php';
require_once 'Database.php';
require_once 'utils/handle-client-date.php';
require_once 'utils/transform-to-js-date.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $postData = file_get_contents('php://input');
    
    // Decode the JSON data
    $jsonData = json_decode($postData, true);
    
    // Check if the JSON decoding was successful
    if ($jsonData) {
      // Get the username from the JSON data
      $name = $jsonData['name'];
      $created_at = handleClientDate($jsonData['created_at']);
      $updated_at = handleClientDate($jsonData['updated_at']);

      
      $user = new User();
    
      // Set the user data
      $user->setName($name);
      $user->setCreatedAt($created_at);
      $user->setUpdatedAt($updated_at);
    
      // Create the user
      $user = $user->create();

      // Check if the user creation was successful
      if ($user) {
        // Set the response status code
        http_response_code(200);
        // Set the response content type
        header('Content-Type: application/json');
        // Convert the user object to JSON
        $userJson = json_encode([
          'id' => $user->getId(),
          'name' => $user->getName(),
          'created_at' => transformToJsDate($user->getCreatedAt()),
          'updated_at' => transformToJsDate($user->getUpdatedAt())
        ]);
        // Output the JSON response
        echo $userJson;
      } else {
        // Set the response status code
        http_response_code(500);
        // Output an error message
        echo 'Failed to create user.';
      }
    } else {
      // Set the response status code
      http_response_code(400);
      // Output an error message
      echo 'Invalid JSON data.';
    }
} else {
    // Set the response status code
    http_response_code(405);
    // Output an error message
    echo 'Method Not Allowed.';
}
