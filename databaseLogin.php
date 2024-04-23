<?php
class DatabaseLogin
{
  private $login;
  private $pass;
  private $sql;
  private $host;

  private $conn;

  private
    $credentials = array();

  function __construct($file)
  {
    $newFile = file($file);
    // Array to store credentials

    foreach ($newFile as $line) //for each line in the file: 
    {
      // Split the line into an array of 2 words: hostname key and credential value.
      $parts = explode('=', $line);
      //Trim whitespace.
      $this->credentials[trim($parts[0])] = trim($parts[1]);
    }
    $this->conn = new mysqli($this->credentials['hostname'], $this->credentials['username'], $this->credentials['password'], $this->credentials['database']);
    if ($this->conn->connect_error) {
      exit("Connection failed: " . $this->conn->connect_error);
    } else {
      echo "Connection Success!";
    }
  }
  function checkLogin($user, $pass)
  {
    $sql = "SELECT username, password FROM users WHERE username = ?";
    $sqlStatement = $this->conn->prepare($sql); // $sqlStatement parses the SQL line above and reads the question mark as a placeholder.
    $sqlStatement->bind_param("s", $user); // "s" defines the parameter as a string value. This replaces the question mark.
    $sqlStatement->execute(); // Sends the line of code.
    $result = $sqlStatement->get_result();
    //At this point, the username and password should be returned. However, if the inputted username was not registered into the database,
    //Then we should return them to login with the error.

    //If the result doesn't return an entry:
    if ($result->num_rows != 1) {
      $error_message = "Invalid Username.";
      $this->conn->close();
      header("Location: login.php?error=" . urlencode($error_message)); //Sends back the error message, see login.php error to see why we send this back with the page.
      exit;
    } else {
      $rows = $result->fetch_assoc(); // Turn data into associative array.
      print_r($rows);
      if ($user == $rows['username'] && $pass == $rows['password']) {
        /* If the information looks good, let's prepare a cookie so the dashboard page can get the correct data.
          */
        $dataForCookie = array("user" => $user);
        $jsonCookie = json_encode($dataForCookie);
        setcookie("login", $jsonCookie, time() + 3600, "/");

        $sqlStatement->close();
        $this->conn->close();
        header("Location: dashboard.php");
        exit;
      } elseif ($pass != $rows['password']) {
        $error_message = "Invalid password.";
        $this->conn->close();
        header("Location: login.php?error=" . urlencode($error_message)); //Sends back the error message, see login.php error to see why we send this back with the page.
        exit;
      }
    }
  }

  function addUser($username, $password)
  {
    $sql = "INSERT INTO users (username, password) VALUES(?, ?);";
    $sqlStatement = $this->conn->prepare($sql);
    $sqlStatement->bind_param("ss", $username, (string)$password);
    $sqlStatement->execute();

    $this->conn->close();

    $this->conn = new mysqli($this->credentials['hostname'], $this->credentials['username'], $this->credentials['password']);

    $sql = "CREATE DATABASE IF NOT EXISTS " . $username;
    $this->conn->query($sql);

    $sql = "USE " . $username . ";";
    $this->conn->query($sql);



    $sql = "CREATE TABLE IF NOT EXISTS times(entry INT PRIMARY KEY AUTO_INCREMENT, startTime DATETIME, endTime DATETIME);";
    $this->conn->query($sql);

    header("Location: login.php");
  }
}
