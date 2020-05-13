<?php
/**
 * Created by PhpStorm.
 * User: Kuldeep Dhaka
 * Date: 02-May-20
 * Time: 1:19 AM
 */
include '../include/db_config.php';

$question = ucfirst($_GET['question']);
$option1 = ucwords($_GET['option1']);
$option2 = ucwords($_GET['option2']);
$option3 = ucwords($_GET['option3']);
$optionC = ucwords($_GET['optionC']);

$query = "INSERT INTO questions(question,option1,option2,option3,optionC) VALUES('$question','$option1','$option2','$option3','$optionC')";

if(mysqli_query($conn,$query)){
    mysqli_close($conn);
    header("Location:../exam/addPaper.php?code=10");
}
else{
    mysqli_close($conn);
    header("Location:../exam/addPaper.php?code=11&question='$question'&option1='$option1'&option2='$option2'&option3='$option3'&optionC='$optionC'");
}