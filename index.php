<?php

session_start();
if (isset($_SESSION['login_status'])){
if ($_SESSION['login_status']==1)
header("Location:profile.php");}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">
      <title>Online Exam</title>
      <link rel="stylesheet" href="style/style.css">
      <link rel="stylesheet" href="style/footer.css">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

      <!-- CSS FILES -->
  </head>
  <body>
  <?php include 'hNf/main_header.php' ?>
<div class="login-box">
  <h1>Login</h1>
    <form method="post" action="processes/user_login_process.php">
      <div class="textbox">
        <i class="fas fa-at"></i>
        <input type="email" placeholder="Email" name="email" required>
      </div>

      <div class="textbox">
        <i class="fas fa-lock"></i>
        <input type="password" placeholder="Password" name="password" required>
      </div>
        <div class="alert-div">
          <?php if(isset($_GET['code'])){
              if ($_GET['code'] == 0) {
                  echo '<div class="alert-danger text-center" >Authentication Failed!</div >';
              }
              elseif ($_GET['code']==2){
                  echo '<div class="alert-info text-center" >Registered Successfully</div >';
              }
          }?>
          </div>
        <div class="btns">
            <input type="submit" class="signInBtn" value="Sign in">
            <a href="signup.php"><input type="button" class="signUpBtn" value="Sign up" name="signUp"></a>
        </div>
    </form>

    </div>
    <?php include "hNf/footer.php";?>
  </body>
</html>
