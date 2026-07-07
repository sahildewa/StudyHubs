<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $standard = mysqli_real_escape_string($conn, $_POST['standard']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$username = mysqli_real_escape_string($conn, $_SESSION['username']);

$file = mysqli_real_escape_string($conn, $_FILES['file']['name']);
$temp_name = $_FILES['file']['tmp_name'];
$folder = "notes/" . $file;


    if (move_uploaded_file($temp_name, $folder)) {

        $query = "INSERT INTO notes (standard, subject, file_name, username, status)
                  VALUES ('$standard', '$subject', '$file', '$username', 'pending')";

        mysqli_query($conn, $query);

        echo "<script>alert('Note uploaded successfully! Waiting for admin approval.');</script>";
    } else {
        echo "<script>alert('File upload failed!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Notes</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="sahil">

    <h2>Upload Your Notes</h2>
<div class="notes-container1 ">

    <form method="POST" enctype="multipart/form-data">
        <select name="standard">
            <option value="11th Science">11th Science</option>
            <option value="11th Commerce">11th Commerce</option>
            <option value="12th Science">12th Science</option>
            <option value="12th Commerce">12th Commerce</option>
    <option value="FY.IT Sem 1">FY.IT Sem 1</option>
     <option value="FY.CS Sem 1">FY.CS Sem 1</option>
     <option value="FY.IT Sem 2">FY.IT Sem 2</option>
     <option value="FY.CS Sem 2">FY.CS Sem 2</option>
     <option value="SY.IT Sem 3">SY.IT Sem 3</option>
     <option value="SY.CS Sem 3">FY.CS Sem 3</option>
     <option value="SY.IT Sem 4">SY.IT Sem 4</option>
     <option value="SY.CS Sem 4">SY.CS Sem 4</option>
     <option value="TY.IT Sem 5">TY.IT Sem 5</option>
    <option value="TY.CS Sem 5">TY.CS Sem 5</option>
    <option value="TY.IT Sem 6">TY.IT Sem 6</option>
    <option value="TY.CS Sem 6">TY.CS Sem 6</option>
</select>


<label>Subject:</label>
<input type="text" name="subject" required>

<label>Select PDF File:</label>
<input type="file" name="file" accept="application/pdf" required>

<br>

<button type="submit" class="nav-btn">Upload Note</button> </div>

</form>
<div class="auth-nav">
    <a href="index.php" class="nav-btn">Back</a>
</div>

</body>
</html> 
