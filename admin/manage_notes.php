<?php
session_start();
include "../config.php";

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
    <title>Manage Notes | StudyHubs</title>
    <link rel="stylesheet" href="../assets/css/style.css?v=<?php echo time(); ?>">

</head>
<body>

<table class="admin-table">
    <tr>
        <th>Standard</th>
        <th>Subject</th>
        <th>File Name</th>
        <th>Uploaded</th>
        <th>View</th>
        <th>Delete</th>
    </tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM notes ORDER BY uploaded_at DESC");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
            <td>'.$row['standard'].'</td>
            <td>'.$row['subject'].'</td>
            <td>'.$row['file_name'].'</td>
            <td>'.$row['uploaded_at'].'</td>
            <td>
                <a href="https://sahil-studyhubs-notes.s3.amazonaws.com/'.$row['file_name'].'" target="_blank" class="view-btn">
                    View
                </a>
            </td>
            <td>
                <a href="delete_notes.php?id='.$row['id'].'"
                   class="delete-btn"
                   onclick="return confirm(\'Are you sure you want to delete this note?\');">
                    Delete
                </a>
            </td>
        </tr>';
    }
} else {
    echo "<tr><td colspan='6'>No notes found.</td></tr>";
}
?>

</table>



    <br>
    <div class="center-btn">
    <a href="dashboard.php" class="nav-btn login">⬅ Back to Dashboard</a>
</div>

</div>

</body>
</html>
