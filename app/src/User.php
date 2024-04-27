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
      $query = "INSERT INTO users (name, created_at, updated_at) VALUES (?, ?, ?)";
      $statement = $connection->prepare($query);
      $statement->bind_param("sss", $this->name, $this->created_at, $this->updated_at);
      // Execute the query
      $statement->execute();

      if ($statement->error) {
        // Handle the case where there was an error with the query
        // For example, you could throw an exception
        throw new Exception($statement->error);
      }

      if ($statement->affected_rows === 0) {
        // Handle the case where no rows were affected by the query
        // For example, you could throw an exception
        throw new Exception("No rows were affected by the query.");
      }

      if ($statement->affected_rows === -1) {
        // Handle the case where the query failed
        // For example, you could throw an exception
        throw new Exception("The query failed.");
      }

      if ($statement->affected_rows === 1) {
        // Handle the case where the query was successful
        // For example, you could return the newly created user
        // Get the id of the newly created user
        $this->id = $statement->insert_id;
        // Close the statement and connection
        $statement->close();
        $connection->close();
        return $this;
      }
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

        if ($user) {
          $this->id = $user['id'];
          $this->name = $user['name'];
          $this->created_at = $user['created_at'];
          $this->updated_at = $user['updated_at'];
        } else {
          // Handle the case where no user was found
          // For example, you could throw an exception
          throw new Exception("No user found with id $id");
        }

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