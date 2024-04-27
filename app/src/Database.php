<?php

class Database {
    private $host = "db";
    private $username = "test";
    private $password = "test";
    private $database = "test";

    private $connection;

    

    public function connect() {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $this->connection;
    }

    public function query($sql) {
        $result = mysqli_query($this->connection, $sql);

        if (!$result) {
            die("Query failed: " . mysqli_error($this->connection));
        }

        return $result;
    }

    public function close() {
        mysqli_close($this->connection);
    }
}