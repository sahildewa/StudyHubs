<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "studyhubs_db"; // my database name

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed");
}
?>
