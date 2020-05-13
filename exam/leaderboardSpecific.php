<!DOCTYPE HTML>
<html>
<head>
    <title>Leaderboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <script src="../style/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="../style/inside_footer.css">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/randomExam_style.css">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        .card{
            margin: 20px;
        }
        .card-title{
            padding: 10px;
        }
    </style>
</head>
<body>
<?php
session_start();
if(!(isset($_SESSION['login_status'])&&$_SESSION['login_status']==1))
    header("Location:../index.php");
include_once '../hNf/exam_header.php';
include_once "../include/db_config.php";?>

<div class="card">
    <div class="text-center card-title bg-dark text-white">
       <h4>Leaderboard</h4>
    </div>
    <div class="card-body">
        <table>
            <tr>
                <th>Sr.</th>
                <th>Name</th>
                <th class="text-center">Accuracy</th>
            </tr>
            <?php
            $query = "SELECT name,accuracy from students ORDER BY accuracy DESC";
            $i=1;
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    $name = $row['name'];
                    $accuracy = $row['accuracy'];
                    echo "<tr><td>$i</td> <td>$name</td><td>$accuracy%</td> </tr>";
                    $i++;
            }}
            ?>
        </table>
    </div>
</div>
</body>
</html>