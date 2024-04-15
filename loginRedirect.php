<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirection</title>
</head>
<body>
    <?php 
    include("databaseLogin.php");
    $user = $_POST['username'];
    $pass = $_POST['password'];

    //We need this function for cookie implementation later. This starts a session cookie
    // and also allows us to gather/send cookie data to other webpages.
    session_start(); 

    //Instantiate database
    $db = new DatabaseLogin("credentials.txt");
    
    $db->checkLogin($user, $pass);
    ?>
</body>
</html>
