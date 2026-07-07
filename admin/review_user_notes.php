<?php
session_start();
include "../config.php";

$query = "SELECT * FROM notes WHERE status='pending'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Review User Notes</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="notes-container">
    <h2>Pending User Notes</h2>


<table class="admin-table">

    <tr>
        <th>Username</th>
        <th>Standard</th>
        <th>Subject</th>
        <th>Preview</th>
        <th>Approve</th>
        <th>Reject</th>
    </tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?php echo $row['username']; ?></td>
    <td><?php echo $row['standard']; ?></td>
    <td><?php echo $row['subject']; ?></td>
    <td>
        <a href="../notes/<?php echo $row['file_name']; ?>" target="_blank">View</a>

    </td>
    <td>
        <a href="approve_note.php?id=<?php echo $row['id']; ?>" class="view-btn">Approve</a>
    </td>
    <td>
       <a href="reject_note.php?id=<?php echo $row['id']; ?>" class="delete-btn">Reject</a>

    </td>
</tr>

<?php } ?>

</table>
<div class="center-btn">
    <a href="dashboard.php" class="nav-btn login">⬅ Back to Dashboard</a>
</div>
</body>
</html>
