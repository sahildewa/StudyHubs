<?php
session_start();
include "config.php";

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "user";

    $check = mysqli_query($conn, "SELECT * FROM userdetails WHERE username='$username'");

    if (mysqli_num_rows($check) > 0) {
        $error = "Username already exists!";
    } else {
    mysqli_query($conn, "INSERT INTO userdetails (username, password, role) VALUES ('$username', '$password', '$role')");

    echo "<script>
        alert('Registration successful! Please login.');
        window.location.href = 'login.php';
    </script>";
    exit();
}

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | StudyHubs</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-body">


<div class="auth-box">
    <h2>Create Account</h2>

    <form method="POST">
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit" name="register" class="main-btn">
        Register
    </button>
</form>


    <p class="auth-link">
        Already have an account?
        <a href="login.php">Login</a>
    </p>
</div>
<div class="auth-nav">
    <a href="index.php" class="nav-btn">Back</a>
</div>


</body>
</html>
