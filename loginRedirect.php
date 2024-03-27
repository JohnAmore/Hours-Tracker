<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect Webpage</title>
</head>
<body>
    <?php
    //We need this function for cookie implementation later. This starts a session cookie
    // and also allows us to gather/send cookie data to other webpages.
    session_start(); 
    
    /*
        The next few lines are file I/O that will recieve the credentials for the database.
        Security feature.
    */
    $file = file('credentials.txt'); // File object
    $credentials = array(); // Array to store credentials

    foreach ($file as $line) //for each line in the file: 
    { 
        // Split the line into an array of 2 words: hostname key and credential value.
        $parts = explode('=', $line); 
        //Trim whitespace.
        $credentials[trim($parts[0])] = trim($parts[1]);
    }
    //END OF FILE I/O SECTION



    // Retrieve user input
    $userInputuser = $_POST['username'];
    $userInputpass = $_POST['password'];
    
    // Establish connection to the database
    $conn = new mysqli($credentials['hostname'], $credentials['username'], $credentials['password'], $credentials['database']);
    if ($conn->connect_error) 
    {
        exit("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare and execute SQL query to retrieve username and user ID.
    $sql = "SELECT user_id, username FROM users WHERE username = ?"; // The question mark here is a placeholder. We use this method to prevent SQL Injection.
    $sqlStatement = $conn->prepare($sql); // $sqlStatement parses the SQL line above and reads the question mark as a placeholder.
    $sqlStatement->bind_param("s", $userInputuser); // "s" defines the parameter as a string value. This replaces the question mark.
    $sqlStatement->execute(); // Sends the line of code.
    $result = $sqlStatement->get_result();
    
    if ($result->num_rows == 0) // If the result doesn't return a row for the details, then we know that the username is incorrect.
    { 
        $error_message = "Invalid Username.";
        header("Location: login.php?error=" . urlencode($error_message)); //Sends back the error message, see login.php error to see why we send this back with the page.
        exit;
    }
    
    // Get user details so we can use it for cookie sending later.
    $row = $result->fetch_assoc(); //Convert result into an associative array.
    $userID = $row['user_id'];
    $username = $row['username'];
    
    // Prepare and execute SQL query to retrieve password.
    $sql = "SELECT pass FROM passwords WHERE user_id = ?"; // The question mark here is a placeholder. We use this method to prevent SQL Injection.
    $sqlStatement = $conn->prepare($sql); // $sqlStatement parses the SQL line above and reads the question mark as a placeholder.
    $sqlStatement->bind_param("i", $userID); // "i" defines the parameter as an integer value. This replaces the question mark.
    $sqlStatement->execute(); // Sends the line of code.
    $result = $sqlStatement->get_result();
    
    if ($result->num_rows == 0) // If the result doesn't return a row for the details, then we know that the password is incorrect.
    { 
        $error_message = "Invalid password.";
        header("Location: login.php?error=" . urlencode($error_message));
        exit;
    }
    
    // Build and encode the cookie in JSON for the next webpage. We encode it so we can hold multiple values.
    $dataForCookie = array("user" => $username, "user_id" => $userID);
    $jsonCookie = json_encode($dataForCookie);
    
    // Send the cookie, lasts for 1 hour.
    setcookie("login", $jsonCookie, time() + 3600, "/");
    
    // Redirect to dashboard if there's no issues.
    header("Location: dashboard.php");
    exit;
    
    // Close the connections.
    $sqlStatement->close();
    $conn->close();
    ?>

</body>
</html>
