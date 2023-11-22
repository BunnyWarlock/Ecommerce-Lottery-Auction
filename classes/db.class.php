<?php

/**
 * This class connects to the database named 'ShopDB'
 */
class Db{
  private $host = "localhost:3306";
  private $dbname = "ShopDB";
  private $username = "root";
  private $password = "";

  /**
 * Establish a database connection using the provided credentials.
 *
 * This method creates a connection to a MySQL database using the provided
 * hostname, username, password, and database name. If the connection is
 * successful, a MySQLi object is returned for further database operations.
 * If the connection fails, the script terminates with an error message.
 *
 * @return mysqli|false A MySQLi object representing the database connection
 *                      if successful, or false if the connection fails.
 */
  protected function connect(){
    $mysqli = new mysqli(hostname: $this->host,
                         username: $this->username,
                         password: $this->password,
                         database: $this->dbname);
    if ($mysqli->connect_errno)
      die("Connection Error: " . $mysqli->connect_errno);

    return $mysqli;
  }
}
