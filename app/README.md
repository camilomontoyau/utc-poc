# My PHP CRUD App

This is a simple PHP CRUD (Create, Read, Update, Delete) application that connects to a MySQL database. It allows you to manage user data through a web interface.

## Project Structure

```
my-php-crud-app
├── src
│   ├── index.php
│   ├── User.php
│   ├── Database.php
│   ├── create.php
│   ├── read.php
│   ├── update.php
│   └── delete.php
├── docker-compose.yml
├── Dockerfile
├── .env
└── README.md
```

## Files

### `src/index.php`

This file is the entry point of the application. It handles the routing and includes the necessary files for CRUD operations.

### `src/User.php`

This file exports a class `User` which represents a user entity. It has properties for user data and methods for CRUD operations such as create, read, update, and delete.

### `src/Database.php`

This file exports a class `Database` which handles the database connection and query execution. It has methods for connecting to MySQL and executing queries.

### `src/create.php`

This file handles the creation of a new user. It includes the necessary files and calls the appropriate methods from the `User` class.

### `src/read.php`

This file handles the retrieval of user data. It includes the necessary files and calls the appropriate methods from the `User` class.

### `src/update.php`

This file handles the updating of user data. It includes the necessary files and calls the appropriate methods from the `User` class.

### `src/delete.php`

This file handles the deletion of a user. It includes the necessary files and calls the appropriate methods from the `User` class.

### `docker-compose.yml`

This file is the configuration file for Docker Compose. It defines the services required to run the PHP application and MySQL database.

### `Dockerfile`

This file is used by Docker to build the PHP application image. It specifies the base image, copies the necessary files, and sets up the environment.

### `.env`

This file contains environment variables used by the Docker Compose file, such as the MySQL database credentials.

## Usage

1. Make sure you have Docker and Docker Compose installed on your system.
2. Clone this repository.
3. Navigate to the project directory.
4. Rename the `.env.example` file to `.env` and update the MySQL database credentials.
5. Run the following command to start the application:

   ```
   docker-compose up -d
   ```

6. Access the application in your web browser at `http://localhost:8000`.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.