<?php
/**
 * Created by PhpStorm.
 * User: Kuldeep Dhaka
 * Date: 24-Mar-20
 * Time: 6:52 PM
 */

session_start();
if (isset($_SESSION['login_status'])){
    if ($_SESSION['login_status']==1)
        header("Location:profile.php");
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
</head>
<body>
<h1 class="header">Online Exam</h1>
<div class="login-box">
    <h1>Register</h1>
    <form method="post" action="processes/signup_process.php">
        <div class="textbox">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Full Name" name="fullname" required>
        </div>
        <div class="textbox">
            <i class="fas fa-at"></i>
            <input type="email" placeholder="Email" name="email" required>
        </div>

        <div class="textbox">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" required>
        </div>

        <div class="textbox">
            <i class="far fa-address-book"></i>
            <input type="text" placeholder="Mobile Number" name="mobilenumber" required>
        </div>
        <div class="alert-div">
            <?php if(isset($_GET['code'])){
                if ($_GET['code']==1){
                    echo '<div class="alert-danger text-center" >SignUp Failed!</div >';
                }
            }?>
        </div>
        <div class="btns">
            <a href="index.php"><input type="button" class="signUpBtn" value="Login"></a>
            <input type="submit" class="signInBtn" value="Sign up" name="signUp">
        </div>
    </form>
</div>
<?php include "hNf/footer.php";?>
</body>
</html>


