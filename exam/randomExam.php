<?php
/**
 * Created by PhpStorm.
 * User: Kuldeep Dhaka
 * Date: 30-Apr-20
 * Time: 3:49 PM
 */


include '../include/db_config.php';
session_start();
if(!(isset($_SESSION['login_status']) && $_SESSION['login_status'] == 1)){
    header("Location:../index.php");
}

$query = "SELECT COUNT(question) AS no_questions from questions";
$max = 0;
$row = mysqli_fetch_assoc(mysqli_query($conn,$query));
$m = (int)$row['no_questions'];
$maxQuestion = 2;


function non_repeat($min, $max, $count, $sort = false)
{
    if ($max - $min < $count) {
        return false;
    }
    $arr = range($min, $max);
    $arr_rnd = array_rand($arr, $count);
    foreach ($arr_rnd as $each) {
        $nonrepeatarray[] = $arr[$each];
    }
    if (!$sort) {

        shuffle($nonrepeatarray);
    }

    return $nonrepeatarray;
}

function to_javascript_array($arr){
    $J_arr = "[";
    foreach ($arr as $value){
        $J_arr .= $value . ",";
    }

    $J_arr = rtrim($J_arr,",");
    $J_arr .= "]";
    return $J_arr;
}

$test = non_repeat(1, $m, $maxQuestion,false);

$s = to_javascript_array($test);

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Computer Exam</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <script src="../style/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="../style/randomExam_style.css">
    <link rel="stylesheet" href="../style/inside_footer.css">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
</head>
<body>
    <?php include '../hNf/exam_header.php';?>
    <div class="container text-center startExam">
        <button class="btn btn-warning font-weight-bold" id="startExam">Start Exam</button>
        <div class="gap"></div>
        <div class="card">
            <div class="card-body text-left">
                <h5>Rules & Information:</h5><br>
                <h6>1.All the questions must be attempted.</h6>
                <h6>2.Exam result will be shown after the last question & by clicking Finish & show result.</h6>
            </div>
        </div>
    </div>
<div class="container Main">
    <div class="card exam">
        <div class="loader"></div>
        <div class="card-header text-center bg-dark text-white">
            <!--Question No-->
            <h4 id="question_no"></h4>
        </div>
        <div class="card-body">
            <!--Question-->
            <h5 class="card-title question"></h5>

            <input type="radio" class="op1" name="option" value="1">
            <label id="1"></label><br>

            <input type="radio" class="op2" name="option" value="2">
            <label id="2"></label><br>

            <input type="radio" class="op3" name="option" value="3">
            <label id="3"></label><br>

            <input type="radio" class="op4" name="option" value="4">
            <label id="4"></label><br>

        </div>
        <div class="card-footer">
            <button class="btn btn-secondary" id="previousQuestion" disabled>Previous</button>
            <button class="btn btn-primary" id="nextQuestion" disabled>Next</button>
            <button class="btn btn-warning float-right" id="finishTest" disabled>Finish & Show Result</button>
    </div>

</div>
</div>
    <div class="container finish">

    </div>
    <div class='alert-info  text-center size-40' id="score-update" >Score updated.</div>
    <div class="text-center score">


    </div>

    <script>
        let question_count = 0;
        let response = null;
        // noinspection JSAnnotator
        const maxQuestion = <?php echo ($maxQuestion-1);?>;
        let question = [];
        let score = 0;
        let arr = [1, 4, 3, 2];

        let mask = $('<div></div>')
            .css({
                position: 'absolute',
                width: '100%',
                height: '100%',
                top: 0,
                left: 0,
                'z-index': 10000
            })
            .appendTo($('.exam'))
            .click(function(event){
                event.preventDefault();
                return false;
            });
        arr = shuffle(arr);
        //shuffle
        function shuffle(array) {
            let tmp, current, top = array.length;
            if(top) while(--top) {
                current = Math.floor(Math.random() * (top + 1));
                tmp = array[current];
                array[current] = array[top];
                array[top] = tmp;
            }
            return array;
        }

        <?php echo "var questions = $s;\n";?>
        $(document).ready(function () {
            $("#score-update").hide();
            $(".Main").hide();
            $("#startExam").click(function () {
                startExam();
            });
            $('#nextQuestion').click(function () {
                $(".loader").show();
                nextQuestion();
            });

            $("input").click(function () {
                if(question_count !== maxQuestion)
                    $("#nextQuestion").prop("disabled",false);
                else
                    $("#finishTest").prop("disabled",false);
            });

            $("#previousQuestion").click(function () {
                $("#finishTest").prop("disabled",true);
                previousQuestion()
            });
            $("#finishTest").click(function () {
                question[question_count].userAnswer = $('input[name="option"]:checked').val().toString();
                finishTest();
                updateScore();
            });


            function previousQuestion() {
                question_count--;
                loadQuestion();
            }

            function finishTest() {
                $(".Main").hide();
                for(question_count = 0;question_count <=maxQuestion; question_count++){
                    $(".finish").append("<div class='card-body answers'>" +
                        "<div class='card'><div class='card-body'><h5 class='text-red'>Q."+(question_count+1) +" " + question[question_count].ques
                        +"</h5><br><p class='font-weight-bold'>Correct Answer: "+question[question_count].ac +"</p>" +
                        "<br><p class='font-weight-bold'>Your Answer: "+ question[question_count].userAnswer.toString() +"</p></div></div>")

                    if(question[question_count].userAnswer === question[question_count].ac){
                        score += 1;
                    }
                }
                $(".score").append("<h4>Score: "+ score +" Out of "+ (maxQuestion+1) +"</h4><br>" +
                    "<button class='btn btn-primary newExam' onclick='window.location.reload()'>New Exam</button>");
            }

            function updateScore() {
                $.ajax({
                    type:"Post",
                    url:"../processes/getQuestion.php",
                    data:{score : score},
                    success: function (data) {
                        $("#score-update").html(data).show().delay(3000).fadeOut()
                    }})
            }
            function nextQuestion() {
                question[question_count].userAnswer = $('input[name="option"]:checked').val().toString();
                question_count++;
                $("input[name=option]").prop("checked",false);
                loadQuestion();
            }
            function startExam() {
                $(".startExam").hide();
                $(".Main").show();
                loadQuestion();
            }
            function loadQuestion(){
                if(question_count > 0)
                    $("#previousQuestion").prop("disabled",false);

                else
                    $("#previousQuestion").prop("disabled",true);

                if(question_count === maxQuestion){
                    $("#nextQuestion").prop("disabled",true);
                }

                if(window.XMLHttpRequest){
                    xmlHttp = new XMLHttpRequest();
                }
                else{
                    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlHttp.onreadystatechange = function (ev) {
                    if(this.readyState == 4 && this.status == 200){
                        response = this.responseText;
                        $("#question_no").text("Question " + (question_count+1));
                        question[question_count] = JSON.parse(response);
                        //Set Question
                        $(".question").text(question[question_count].ques);
                        $("#"+arr[0]).text(question[question_count].a1);
                        $("#"+arr[1]).text(question[question_count].a2);
                        $("#"+arr[2]).text(question[question_count].a3);
                        $("#"+arr[3]).text(question[question_count].ac);
                        $(".op"+arr[0]).val(question[question_count].a1);
                        $(".op"+arr[1]).val(question[question_count].a2);
                        $(".op"+arr[2]).val(question[question_count].a3);
                        $(".op"+arr[3]).val(question[question_count].ac);
                        $(".loader").hide();
                        mask.remove();
                    }
                };
                xmlHttp.open("GET","../processes/getQuestion.php?q="+ questions[question_count]);
                xmlHttp.send();
            }
        })
    </script>
    <?php include_once '../hNf/inside_footer.php' ?>
</body>
</html>
