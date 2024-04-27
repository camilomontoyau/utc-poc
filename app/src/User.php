<?php

class User {
    private $id;
    private $name;
    private $created_at;
    private $updated_at;

    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    public function getData() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function create() {
      // Connect to the database
      $db = new Database();
      $connection = $db->connect();

      // Prepare the query
      $query = "INSERT INTO users (name, create_at, updated_at) VALUES (?, ?, ?)";
      $statement = $connection->prepare($query);
      $statement->bind_param("s", $this->name);
      // Execute the query
      $statement->execute();
      // Set the id of the newly created user
      $this->id = $statement->insert_id;

      $createdUser = $this->read($this->id);

      // Close the statement and connection
      $statement->close();
      $connection->close();

      return $createdUser;
    }

    public function readAll() {
        // Connect to the database
        $db = new Database();
        $connection = $db->connect();

        // Prepare the query
        $query = "SELECT * FROM users";
        $statement = $connection->prepare($query);

        // Execute the query
        $statement->execute();

        // Fetch the result
        $result = $statement->get_result();
        $users = [];
        while ($user = $result->fetch_assoc()) {
            $users[] = $user;
        }

        // Close the statement and connection
        $statement->close();
        $connection->close();

        return $users;
    }

    public function read($id) {
        // Connect to the database
        $db = new Database();
        $connection = $db->connect();

        // Prepare the query
        $query = "SELECT * FROM users WHERE id = ?";
        $statement = $connection->prepare($query);
        $statement->bind_param("i", $id);

        // Execute the query
        $statement->execute();

        // Fetch the result
        $result = $statement->get_result();
        $user = $result->fetch_assoc();

        $this->id = $user['id'];
        $this->name = $user['name'];
        $this->created_at = $user['created_at'];
        $this->updated_at = $user['updated_at'];

        // Close the statement and connection
        $statement->close();
        $connection->close();

        return $this;
    }

    public function update() {
        // Connect to the database
        $db = new Database();
        $connection = $db->connect();

        // Prepare the query
        $query = "UPDATE users SET name = ? WHERE id = ?";
        $statement = $connection->prepare($query);
        $statement->bind_param("si", $this->name, $this->id);

        // Execute the query
        $statement->execute();

        // Close the statement and connection
        $statement->close();
        $connection->close();
    }

    public function delete($id) {
        // Connect to the database
        $db = new Database();
        $connection = $db->connect();

        // Prepare the query
        $query = "DELETE FROM users WHERE id = ?";
        $statement = $connection->prepare($query);
        $statement->bind_param("i", $id);

        // Execute the query
        $statement->execute();

        // Close the statement and connection
        $statement->close();
        $connection->close();
    }
}