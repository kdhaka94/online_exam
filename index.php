<?php

session_start();
if (isset($_SESSION['login_status'])){
    if ($_SESSION['login_status']==1)
        header("Location:profile.php");}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Online Exam</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<img class="wave" src="img/wave.png">
<div class="container">
    <div class="img">
        <img src="img/exam.svg">
    </div>
    <div class="login-content">
        <form method="post" action="processes/user_login_process.php">
            <img src="img/avatar.svg">
            <h2 class="title">Welcome</h2>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <h5>Email</h5>
                    <input type="email" class="input" required>
                </div>
            </div>
            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Password</h5>
                    <input type="password" class="input" required>
                </div>
            </div>
            <a class="forgotPassword" href="#">Forgot Password?</a>
            <input type="submit" class="btn" value="Login">
            <p>Don't Have A Account? <a class="signUp" href="signup.php">SignUp</a></p>
        </form>
    </div>
    <div class="notification">
        <?php
        if(isset($_GET['code'])){
            if ($_GET['code'] == 0) {
                echo '<p class="error" hidden>Authentication Failed!</p>';
            }
            elseif ($_GET['code']==2){
                echo '<p class="info" hidden>Registered Successfully</p>';
            }
        }
        ?>
    </div>
</div>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
