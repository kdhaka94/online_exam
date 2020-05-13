<?php
/**
 * Created by PhpStorm.
 * User: Kuldeep Dhaka
 * Date: 25-Mar-20
 * Time: 2:36 PM
 */


date_default_timezone_set("Asia/Kolkata");

function get_ip(){
//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
}
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
//whether ip is from remote address
else
{
    $ip_address = $_SERVER['REMOTE_ADDR'];
}
return $ip_address;
}
//Mark Attendance
function mark_attendance($conn){
    $s_id = $_SESSION['student_id'];
    $date = today_date();
    $query = "INSERT INTO attendance(attendance,student_id,date,exam_id) VALUES ('yes',$s_id,'$date',1)";
    $result = mysqli_query($conn,$query);
    if ($result){
        return 6;

    }
    else{
        return mysqli_error($conn);
    }
}
function check_attendance($conn){
    $s_id = $_SESSION['student_id'];
    $date = today_date();
    $query = "SELECT attendance from attendance WHERE student_id=$s_id AND date='$date'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) > 0){
        return 8;
    }
    else{
        return 9;
    }
}
function today_date(){
    $date=getdate(date("U"));
    return "$date[mon]-$date[mday]-$date[year]";
}
function login_status_checkNgo($dir){
    if(!isset($_SESSION['login_status'])){
        if ($dir == 0){
            header("Location:index.php");
        }
        elseif($dir == 1){
        header("Location:../index.php");
        }
    }

}