<?php
session_start();
include "config.php";   

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notes | StudyHubs</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="notes-container">
    <h2>Available Notes</h2>

    <div class="filter-box">
    <select id="standardFilter" onchange="filterStandard()">
        <option value="all">Select Standard</option>
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
</div>

    <?php
$result = mysqli_query($conn, "
    SELECT * FROM notes 
    WHERE status='approved' 
    ORDER BY standard ASC, uploaded_at DESC
");

$current_standard = "";

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        if ($current_standard != $row['standard']) {

            if ($current_standard != "") {
                echo "</table></div>";
            }

            echo "<div class='standard-box' data-standard='{$row['standard']}'>";
            echo "<div class='standard-title'>{$row['standard']}</div>";

            echo "
            <table class='notes-table'>
                <tr>
                    <th>Subject</th>
                    <th>Preview</th>
                    <th>Download</th>
                </tr>
            ";

            $current_standard = $row['standard'];
        }

       echo "
<tr>
    <td>{$row['subject']}</td>
    <td>
        <a href='https://sahil-studyhubs-notes.s3.us-east-1.amazonaws.com/{$row['file_name']}'
           class='preview-btn'
           target='_blank'>Preview</a>
    </td>
    <td>
        <a href='https://sahil-studyhubs-notes.s3.us-east-1.amazonaws.com/{$row['file_name']}'
           class='download-btn'
           target='_blank'
           download>Download</a>
    </td>
</tr>
";
    }

    echo "</table></div>";

} else {
    echo "<p>No notes uploaded yet.</p>";
}

?>

</div>


<div class="auth-nav">
    <a href="index.php" class="nav-btn">Back</a>
</div>

<script>
function filterStandard() {
    let selected = document.getElementById("standardFilter").value;
    let boxes = document.querySelectorAll(".standard-box");

    boxes.forEach(box => {
        let standard = box.getAttribute("data-standard");

        if (selected === "all" || standard === selected) {
            box.style.display = "block";
        } else {
            box.style.display = "none";
        }
    });
}
</script>
</body>

</html>
