<?php
session_start();
include "config.php";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

   $query = mysqli_query($conn, "SELECT * FROM userdetails WHERE Username='$username'");

$user = mysqli_fetch_assoc($query);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['Username'];  // ✅ capital U
    $_SESSION['role'] = $user['role'];


    if ($user['role'] === 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: index.php");
    }
    exit();
}

    else {
        $error = "Invalid login details";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | StudyHubs</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-body">
   

<div class="auth-box">
    <h2>Login to StudyHubs</h2>

    <form method="POST">

    


    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit" name="login" class="main-btn">
        login
    </button>
</form>


    <p class="auth-link">
        New user? <a href="register.php">Register here</a>
    </p>
</div>
<div class="auth-nav">
    <a href="index.php" class="nav-btn">Back</a>
</div>


</body>
</html>
