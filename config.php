  GNU nano 8.3                                                                                        config.php
<?php

$host = "studyhubs-db.cexucy2800ca.us-east-1.rds.amazonaws.com";
$user = "sahil";
$password = "sahil9870";
$database = "studyhubs";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn)
{
    die("Connection Failed: " . mysqli_connect_error());
}

?>
