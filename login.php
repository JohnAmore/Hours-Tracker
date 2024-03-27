<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hours Tracker</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<?php
session_start();

// Check if an error message is set
$error_message = isset($_GET['error']) ? $_GET['error'] : '';

// Display error message if it exists
if (!empty($error_message)) {

    
    echo '<div class ="errorDiv" id="hideable">
    <button onClick="hide()"class="clickable">
    <span class="errorP">' . $error_message . '</span>
    </button>
    </div>';
}
?>
    <script>
        function hide() 
        {
    var x = document.getElementById("hideable");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
        
    }
    }
    </script>
    <div class="parent">
        <div class="topBar">
            <span class="icon">
                <img src="stopwatch.png" id="icon">
                <!-- Attribution to flaticon.com -->
            </span>
            <span class="title">
                <h2 class="title">Hours Tracker</h2>
            </span>
            
            <!-- TODO: Centered Title, icon, goes here! -->
        </div>  
        <div class="formHolder">
            <form action="loginRedirect.php" class="login" method="post">
                <label for="username"class="inputForm"><strong>Username:</strong></label><br>
                <input type="text"  name="username" id="username"><br>
                <label for="password"class="inputForm"><strong>Password:</strong></label><br>
                <input type="password" name="password" id="password"><br>
                <input type="submit" class="SubmitButton">
            </form>
        </div>
        
    </div>
    <div class="foot">
        <p>Attributions: Stopwatch Icon, <a href="https://www.flaticon.com/free-icons/timer" title="Stopwatch Timer Icon">
            Timer icons created by Freepik - Flaticon</a></p>
        <footer>
            &copy; Copyright 2024 Daniel Bennett, Carson-Newman University
        </footer>
    </div>
</body>

</html>
