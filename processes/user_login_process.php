<?php
/**
 * Created by PhpStorm.
 * User: Sandeep Meena
 * Date: 27-May-19
 * Time: 9:49 PM
 */
include '../include/db_config.php';
include 'user_auth_process.php';

$user_email = $_POST['email'];
$user_password = $_POST['password'];

$response = user_login($user_email, $user_password, $conn);
if ($response == 1){
    header("Location:../profile.php");
}
elseif ($response == 0){
    header("Location:../index.php?code=0");
}