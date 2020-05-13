<?php
/**
 * Created by PhpStorm.
 * User: Kuldeep Dhaka
 * Date: 24-Mar-20
 * Time: 11:15 PM
 */

include "processes/exam_functions.php";
include "processes/data_functions.php";
session_start();

if(!(isset($_SESSION['login_status']) && $_SESSION['login_status'] == 1)){
    header("Location:index.php");
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>
        Welcome <?php echo $_SESSION['full_name'] ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="style/profile_style.css">
    <script src="style/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <script type="text/javascript" src="style/TimeCircles.js"></script>
    <link rel="stylesheet" href="style/TimeCircles.css" />
    <link rel="stylesheet" href="style/inside_footer.css">

</head>
<body>
    <?php include 'hNf/profile_header.php';?>
<div class="container">
    <div class="card">
        <div class="card bg-dark text-white">
            <div class="card-header text-center"><h4>Options</h4></div>
        </div>
        <div class="card-body text-center">
            <a class="top-10" href="#"><button class="btn btn-secondary mt-2 mr-5">Exam Instructions</button></a>
            <a class="top-10" href="#"><button class="btn btn-warning mt-2 mr-5">Attendance</button></a>
            <a class="top-10" href="exam/progress.php"><button class="btn btn-info mt-2 mr-5">Progress</button></a>
            <a class="top-10" href="exam/leaderboardSpecific.php"><button class="btn btn-dark mt-2 mr-5">Leaderboard</button></a>
            <a class="top-10" href="exam/randomExam.php"><button class="btn btn-secondary mt-2">Random Exam</button></a>
           <br>
            <div class="gap-2"></div>
            <div class="card margin-auto" style="width: fit-content">
            <div class="card-header text-center">
                Next exam will commence in
            </div>
                <div class="card-body">
                    <div id="DateCountdown" class="margin-auto" data-date="2020-03-27 19:06:00" style="width: 400px; height: 200px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        $("#DateCountdown").TimeCircles({ time: { Days: { show: false}}});
        setInterval(function () {
            var remaining_second = $("#DateCountdown").TimeCircles().getTime();
            if (remaining_second < 1 && remaining_second > -10 ){
                window.location = ("exam/exam.php?code=<?php echo '';?>");
            }
        },1000);

    </script>
<?php include_once 'hNf/inside_footer.php'?>
</body>
</html>
<?php if(isset($_GET['sign_out'])){
    session_destroy();
    header("Location:index.php");
}?>
