<?php
/**
 * Created by PhpStorm.
 * User: Kuldeep Dhaka
 * Date: 24-Mar-20
 * Time: 11:15 PM
 */
include "../processes/data_functions.php";
session_start();
login_status_checkNgo(1);

$question = "";
$option1 = "";
$option2 = "";
$option3 = "";
$optionC = "";

if(isset($_GET['code']) && $_GET['code'] == 11){
    $question = $_GET['question'];
    $option1 = $_GET['option1'];
    $option2 = $_GET['option2'];
    $option3 = $_GET['option3'];
    $optionC = $_GET['optionC'];
}
?>
<!Doctype HTML>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <script src="../style/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="../style/inside_footer.css">
    <link rel="stylesheet" href="../style/paper_style.css">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
</head>
<body>
<?php include'../hNf/exam_header.php' ?>
<div class="container">
    <div class="card">
        <form action="../processes/question_add.php">
        <div class="card-header text-center bg-dark text-white">
            <!--Question No-->
            <h4>Fill The Following fields</h4>
        </div>
        <div class="card-body">
            <!--Question-->
            <div class="form-group">
                <input type="text" class="form-control" name="question" placeholder="Enter Question" value="<?php echo $question; ?>" required><br>
            </div>
            <div class="form-group">
                <input type="text" name="option1" class="form-control size-40" placeholder="False Option" value="<?php echo $option1; ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="option2" class="form-control size-40" placeholder="False Option" value="<?php echo $option2; ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="option3" class="form-control size-40" placeholder="False Option" value="<?php echo $option3; ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="optionC" class="form-control size-40" placeholder="Correct Option" value="<?php echo $optionC; ?>" required>
            </div>
        </div>
        <div class="card-footer">
            <?php if(isset($_GET['code'])){
                if($_GET['code'] == 10){
                    echo "<div class='alert-info  text-center size-40 float-left' id='hide-10'>Question added successfully!</div>";
                }
                if($_GET['code'] == 11){
                    echo "<div class='alert-danger text-center size-40 float-left' id='hide-10'>Failed to add question!</div>";
                }
            }?>
            <input type="submit" class="btn btn-warning text-right font-weight-bold right-0" value="Add Question">
        </div>
        </form>
    </div>
</div>
<?php include "../hNf/inside_footer.php";?>
</body>
<script type="text/javascript">
    $(document).ready(function () {
        $("#hide-10").delay(5000).fadeOut();
    })
</script>
</html>

