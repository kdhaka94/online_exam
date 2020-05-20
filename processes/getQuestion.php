<?php
/**
 * Created by PhpStorm.
 * User: Kuldeep Dhaka
 * Date: 03-May-20
 * Time: 1:42 PM
 */

error_reporting(0);
include '../include/db_config.php';
session_start();

if(isset($_POST['score'])){
    $id = $_SESSION['student_id'];
    $query = "SELECT marks_obtained,total_attempted from students where id=$id";
    $row = mysqli_fetch_assoc(mysqli_query($conn,$query));
    $getScore = $_POST['score'] + $row['marks_obtained'];
    $attempts = 2 + $row['total_attempted'];
    $accuracy = ($getScore/$attempts)*100;
    $_SESSION['marks_obtained'] = $getScore;
    $_SESSION['total_attempted'] = $attempts;
    $_SESSION['accuracy'] = $accuracy;
    $query = "UPDATE students SET total_attempted=$attempts,marks_obtained=$getScore,accuracy=$accuracy WHERE id=$id";
    $result = mysqli_query($conn,$query);
    if($result){
        echo "Score Updated.";
    }
    else
        echo "Failed to update score!".mysqli_error($conn);
}
if(isset($_GET['q'])){
    $q = $_GET['q'];

    $query = "SELECT * FROM questions WHERE id = $q";
    $row = mysqli_fetch_assoc(mysqli_query($conn,$query));
    $obj->ques = $row["question"];
    $obj->a1 = $row["option1"];
    $obj->a2 = $row["option2"];
    $obj->a3 = $row["option3"];
    $obj->ac = $row["optionC"];
    $obj->userAnswer = "";
    $jsonData = json_encode($obj);
    echo $jsonData;

}
mysqli_close($conn);




