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

if (!isset($_GET['id'])) {
    header("Location: manage_notes.php");
    exit();
}

$note_id = intval($_GET['id']);

$query = mysqli_query($conn, "SELECT file_name FROM notes WHERE id = $note_id");
$note = mysqli_fetch_assoc($query);

if ($note) {

    try {

        $s3->deleteObject([
            'Bucket' => 'sahil-studyhubs-notes',
            'Key'    => $note['file_name']
        ]);

    } catch (AwsException $e) {
        // Ignore if file is already deleted from S3
    }

    mysqli_query($conn, "DELETE FROM notes WHERE id = $note_id");
}

header("Location: manage_notes.php");
exit();
?>
