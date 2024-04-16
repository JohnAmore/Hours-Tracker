<?php
include("readData.php");
if (isset($_COOKIE['login'])) {
    $cookie = json_decode($_COOKIE['login'], true);

    $dbName = $cookie["user"];
}
$tables = json_decode($_POST['selectedRows'], true);


$db = new DataBaseReader("timeReader.txt", $dbName);
print_r($tables[0]['id']);

$db->deleteEntry($tables[0]['id']);

header("Location: dashboard.php");
