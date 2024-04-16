<?php
include("readData.php");
if (isset($_COOKIE['login'])) {
    $cookie = json_decode($_COOKIE['login'], true);

    $dbName = $cookie["user"];
}
