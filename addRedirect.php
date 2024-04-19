<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect</title>
</head>

<body>
    <?php
    include("readData.php");
    if (isset($_COOKIE['login'])) {
        $cookie = json_decode($_COOKIE['login'], true);

        $dbName = $cookie["user"];
    } else {
        header("Location: login.php");
    }



    $db = new DataBaseReader("timeReader.txt", $dbName);


    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    if ($db->addEntry(date('Y-m-d H:i:s', strtotime($startTime)), date('Y-m-d H:i:s', strtotime($endTime)))); {
        header("Location: dashboard.php");
    }



    ?>
</body>

</html>