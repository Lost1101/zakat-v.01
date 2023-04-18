<?php
include "database.php";
$host = "localhost";
$user = "root";
$pass = "";
$database = "zakat1";

$connection = new database($host, $user, $pass, $database);
$connect = new connect($connection);
$conn = $connect->connect();
?>