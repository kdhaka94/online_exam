<!DOCTYPE HTML>
<html>
<head>
    <title>Your progress</title>
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
        .center{
            text-align: center;
        }
    </style>
</head>
<body>
<?php
session_start();
include "../hNf/exam_header.php";
include "../include/db_config.php";
if(!(isset($_SESSION['login_status'])&&$_SESSION['login_status']==1))
    header("Location:../index.php");
?>
<div class="card text-center">
    <div class="card-body">
        <?php
        $name = $_SESSION['full_name'];
            echo "<span><h1><i class='fas fa-user'></i></h1><h5>$name</h5></span>";
        ?>
        <table>
            <tr>
                <th>Marks Obtained</th>
                <th>Total Attempted</th>
                <th class="center">Accuracy</th>
            </tr>
            <tr>
                <td><?php echo $_SESSION['marks_obtained']?></td>
                <td><?php echo $_SESSION['total_attempted']?></td>
                <td class="center"><?php echo $_SESSION['accuracy']?>%</td>
            </tr>
        </table>
    </div>

</div>
</body>
</html>
