<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>StudyHubs</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="background-slider"></div>


<div class="navbar">
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="nav-btn login">Logout</a>
    <?php else: ?>
        <a href="login.php" class="nav-btn login">Login</a>
        <a href="register.php" class="nav-btn register">Register</a>
    <?php endif; ?>
</div>
<div class="container">
    <div class="left">
        <h1>StudyHubs</h1>
        <p>Access study notes easily.</p>
        <a href="notes.php">
           <button class="btn main-btn">Get Notes</button>
        </a>
          <br><br>
    <a href="upload_note_user.php">
    <button class="btn main-btn">Upload Your Notes</button>
</a>

    </div>

    
</div>

<script>
    const images = [
        "assets/image/pexels-george-milton-7034082.jpg",
        "assets/image/pexels-karola-g-6958552.jpg",
        "assets/image/pexels-olly-3755716.jpg",
        "assets/image/pexels-olly-3768172.jpg",
        "assets/image/portrait-pensive-young-girl-making-notes.jpg",
        "assets/image/student-wearing-headphones-holding-notebook-practicing-before-exam.jpg"
    ];

    let current = 0;
    const slider = document.querySelector(".background-slider");

    function changeBackground() {
        slider.style.backgroundImage = `url(${images[current]})`;
        current = (current + 1) % images.length;
    }

    changeBackground(); 
    setInterval(changeBackground, 3000); // changing image  
</script>

</body>
</html>
