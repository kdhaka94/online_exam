<?php
/**
 * Created by PhpStorm.
 * User: Kuldeep Dhaka
 * Date: 28-May-19
 * Time: 7:42 PM
 * @param $email
 * @param $password
 */
include 'data_functions.php';


function user_login($email, $password, $conn){
    $query = "SELECT * FROM students WHERE email='$email' AND password='$password'";
    session_start();
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)){
      $_SESSION['student_id'] = $row['id'];
      $_SESSION['full_name'] = $row['name'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['mobile_number'] = $row['mobile_number'];
      $_SESSION['marks_obtained']= $row['marks_obtained'];
      $_SESSION['total_attempted']= $row['total_attempted'];
      $_SESSION['accuracy']= $row['accuracy'];
      $_SESSION['login_status'] = 1;
    }
        mysqli_close($conn);
        return 1;
    }
else{
        mysqli_close($conn);
        return 0;
    }
}
function signup($fullname, $email,$mobilenumber, $pass, $conn){
    $date = date("Y/m/d");
    $ip = get_ip();
    $query = "INSERT INTO students(name,email,mobile_number,password,last_login,ip_creation) VALUES ('$fullname','$email','$mobilenumber','$pass','$date','$ip')";

    if(mysqli_query($conn,$query)){
        mysqli_close($conn);
        return 2;
    }
    else{
        mysqli_close($conn);
        return 1;
    }

}