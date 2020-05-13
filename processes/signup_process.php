<?php
/**
 * Created by PhpStorm.
 * User: Kuldeep Dhaka
 * Date: 28-May-19
 * Time: 6:08 PM
 */

include 'user_auth_process.php';
include '../include/db_config.php';

$name = ucwords($_POST['fullname']);
$email = $_POST['email'];
$pass = $_POST['password'];
$mobile_number = $_POST['mobilenumber'];

$response = signup($name,$email,$mobile_number,$pass,$conn);

if ($response == 2) {
    header("Location:../index.php?code=2");
}
elseif ($response == 1) {
    header("Location:../signup.php?code=1");
}