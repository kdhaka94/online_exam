<?php
/**
 * Created by PhpStorm.
 * User: Kuldeep Dhaka
 * Date: 28-May-19
 * Time: 3:39 PM
 */

define("host","localhost");
define("user","root");
define("password","kuldeep");
define("database","exam_db");
define("port","3307");

$conn = mysqli_connect(host,user,password,database,port);

date_default_timezone_set("Asia/Kolkata");

function formatedate($date)
{
    return date('h:i A',strtotime($date));
}

