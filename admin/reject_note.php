<?php
include "../config.php";

$id = $_GET['id'];

$query = "DELETE FROM notes WHERE id=$id";
mysqli_query($conn, $query);

header("Location: review_user_notes.php");
exit();
?>
