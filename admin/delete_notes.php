<?php
session_start();
include "../config.php";

// 1. Check admin login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}


// 2. Check if note id exists
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$note_id = $_GET['id'];

// 3. Get file name from database
$query = mysqli_query($conn, "SELECT file_name FROM notes WHERE id = '$note_id'");
$note = mysqli_fetch_assoc($query);

if ($note) {
    $file_path = "../notes/" . $note['file_name'];

    // 4. Delete PDF file from folder
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // 5. Delete note from database
    mysqli_query($conn, "DELETE FROM notes WHERE id = '$note_id'");
}

// 6. Redirect back to dashboard
header("Location: manage_notes.php");
exit();
?>
