<?php
session_start();

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1'
]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $standard = mysqli_real_escape_string($conn, $_POST['standard']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $username = mysqli_real_escape_string($conn, $_SESSION['username']);

    $fileName = $_FILES['file']['name'];
    $tempName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];

    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($extension != "pdf") {
        echo "<script>alert('Only PDF files are allowed!');</script>";
    }
    elseif ($fileSize > 10 * 1024 * 1024) {
        echo "<script>alert('Maximum file size is 10 MB!');</script>";
    }
    else {

        try {

            $s3->putObject([
                'Bucket' => 'sahil-studyhubs-notes',
                'Key' => $fileName,
                'SourceFile' => $tempName,
                'ContentType' => 'application/pdf'
            ]);

            $query = "INSERT INTO notes
            (standard, subject, file_name, username, status)
            VALUES
            ('$standard','$subject','$fileName','$username','pending')";

            mysqli_query($conn, $query);

            echo "<script>alert('Note uploaded successfully! Waiting for admin approval.');</script>";

        }
        catch (AwsException $e)
        {
            echo "<script>alert('S3 Upload Failed!');</script>";
        }

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

<div class="notes-container1">

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

<button type="submit" class="nav-btn">
Upload Note
</button>

</form>

</div>

<div class="auth-nav">
<a href="index.php" class="nav-btn">Back</a>
</div>

</body>
</html>
