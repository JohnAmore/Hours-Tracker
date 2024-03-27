<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
<div class="parent">
        <div class="topBar">
            <span class="icon">
                <img src="stopwatch.png" id="icon">
                <!-- Attribution to flaticon.com -->
            </span>
            <span class="title">
                <h2 class="title">Hours Tracker Registration</h2>
            </span>
            
            <!-- TODO: Centered Title, icon, goes here! -->
        </div>  
        <div class="formHolder">
            <form action="registerRedirect.php" class="login" method="post">
                <label for="username"class="inputForm"><strong>Username:</strong></label><br>
                <input type="text"  name="username" id="username"><br>
                <label for="password"class="inputForm"><strong>Password:</strong></label><br>
                <input type="password" name="password" id="password"><br>
                <label for="passwordCon"class="inputForm"><strong>Confirm Password:</strong></label><br>
                <input type="password" name="passwordCin" id="password"><br>
                <input type="submit" class="SubmitButton">
            </form>
            <h3 class="title">Already a member?</h3>
            <a href="login.php"><button class="SubmitButton">Login!</button></a>
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