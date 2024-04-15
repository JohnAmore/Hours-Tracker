<?php
class DataBaseReader
{
    private $user;
    private $server;
    private $pass;
    private $conn;
    private $db;

    function __construct($db, $file)
    {
        $newFile = file($file);
        $credentials = array(); // Array to store credentials

        foreach ($newFile as $line) //for each line in the file: 
        {
            // Split the line into an array of 2 words: hostname key and credential value.
            $parts = explode('=', $line);
            //Trim whitespace.
            $credentials[trim($parts[0])] = trim($parts[1]);
        }
        $this->conn = new mysqli($credentials['hostname'], $credentials['username'], $credentials['password'], $db);
        if ($this->conn->connect_error) {
            exit("Connection failed: " . $this->conn->connect_error);
        } else {
            echo "Connection Success!";
        }
    }
}
