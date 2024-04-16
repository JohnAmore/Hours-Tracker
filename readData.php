<?php
class DataBaseReader
{
    private $user;
    private $server;
    private $pass;
    private $conn;
    private $db;

    function __construct($file, $db)
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
    }

    function getTimes()
    {
        $sql = "SELECT * FROM `times`";
        $sqlStatement = $this->conn->prepare($sql); // $sqlStatement parses the SQL line above and reads the question mark as a placeholder.
        $sqlStatement->execute(); // Sends the line of code.
        $result = $sqlStatement->get_result();
        return $result;
    }

    function deleteEntry($id)
    {
        $sql = "DELETE FROM times WHERE `times`.`entry` = ?";
        $sqlStatement = $this->conn->prepare($sql); // $sqlStatement parses the SQL line above and reads the question mark as a placeholder.
        $sqlStatement->bind_param("s", $id); //Bind $id to ?
        $sqlStatement->execute(); // Sends the line of code.
        if ($result = $sqlStatement->get_result()) {
            echo "<script>console.log('Success!');</script>";
        }
    }


    //2024-04-01 09:55:12 - Sample Format
    function addEntry($year, $month, $day, $startTime, $endTime)
    {
    }
}
