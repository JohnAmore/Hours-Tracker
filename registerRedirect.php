<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect</title>
</head>

<body>
    <?php
    include("databaseLogin.php");
    $user = $_POST['username'];
    $pass = $_POST['password'];
    //Instantiate database
    $db = new DatabaseLogin("credentials.txt");

    $db->addUser($user, $pass);




    ?>


</body>

</html>