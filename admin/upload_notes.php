<?php
session_start();

require '../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

include "../config.php";

/* Admin protection */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1'
]);

$message = "";

if (isset($_POST['upload'])) {

    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $standard = mysqli_real_escape_string($conn, $_POST['standard']);

    $fileName = $_FILES['pdf']['name'];
    $tempName = $_FILES['pdf']['tmp_name'];
    $fileSize = $_FILES['pdf']['size'];

    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($extension != "pdf") {

        $message = "Only PDF files allowed!";

    }
    elseif ($fileSize > 10 * 1024 * 1024) {

        $message = "Maximum file size is 10 MB.";

    }
    else {

        try {

            $s3->putObject([
                'Bucket'      => 'sahil-studyhubs-notes',
                'Key'         => $fileName,
                'SourceFile'  => $tempName,
                'ContentType' => 'application/pdf'
            ]);

            mysqli_query(
                $conn,
                "INSERT INTO notes
                (subject, standard, file_name, status)
                VALUES
                ('$subject', '$standard', '$fileName', 'approved')"
            );

            $message = "PDF uploaded successfully to Amazon S3!";

        }
        catch (AwsException $e) {

            $message = "S3 Upload Failed: " . $e->getAwsErrorMessage();

        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Upload Notes | Admin</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="notes-container">

<h2>Upload Notes (Admin)</h2>

<?php
if($message!=""){
    echo "<p>$message</p>";
}
?>

<form method="POST" enctype="multipart/form-data">

<select name="standard" required>

<option value="">Select Standard</option>

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

<br><br>

<input type="text" name="subject" placeholder="Subject Name" required>

<br><br>

<input type="file" name="pdf" accept=".pdf" required>

<br><br>

<button type="submit" name="upload" class="main-btn">
Upload PDF
</button>

</form>

<br>

<a href="dashboard.php" class="nav-btn login">
⬅ Back to Dashboard
</a>

</div>

</body>
</html>
