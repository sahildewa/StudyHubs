<?php
session_start();

/* Admin protection */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | StudyHubs</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="notes-container">
    <h2>Admin Dashboard</h2>
    <p>Welcome, Admin</p>

    <div class="notes-grid">
        <a href="upload_notes.php" class="note-card">Upload Notes</a>
        <a href="manage_notes.php" class="note-card">Manage Notes</a>
        <a href="review_user_notes.php" class="note-card">User note upload request</a>
        <div class="auth-nav">
        <a href="../logout.php" class="nav-btn">Logout</a> </div>

    </div>
</div>

</body>
</html>
