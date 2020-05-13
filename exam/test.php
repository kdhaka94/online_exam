

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
<h3 class="text-center heading text-body" >Online Exam</h3>
<div style="padding :20px;"></div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container float-right">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../profile.php">Home</a>
            </li>
            <form action="../profile.php" method="get">
                <input type="submit" name="sign_out" value="Sign Out" class="nav-link bg-dark border-0 btn">
            </form>
        </ul>
        <h6 class="text-light"><i class="fas fa-user"> </i> Kuldeep Dhaka</h6>
    </div>
</nav>
<div class="gap"></div>    <div class="container text-center startExam">
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
    <div class="card">
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
    var question_count = 0;
    var response = null;
    var maxQuestion = 1;
    var question = [];
    var score = 0;
    var arr = [1,4,3,2];
    arr = shuffle(arr);
    //shuffle
    function shuffle(array) {
        var tmp, current, top = array.length;
        if(top) while(--top) {
            current = Math.floor(Math.random() * (top + 1));
            tmp = array[current];
            array[current] = array[top];
            array[top] = tmp;
        }
        return array;
    }

    var questions = [28,3];
    $(document).ready(function () {

        $("#score-update").hide();
        $(".Main").hide();
        $("#startExam").click(function () {
            startExam();
        });
        $('#nextQuestion').click(function () {
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
                    "<div class='card'> <div class='card-body'><h5 class='text-red'>Q."+(question_count+1) +" " + question[question_count].ques
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
                }
            };
            xmlHttp.open("GET","../processes/getQuestion.php?q="+ questions[question_count]);
            xmlHttp.send();
        }
    })
</script>
<div class="footer1 no-bootstrap">
    <div class="footer-left">
        <span><i class="far fa-copyright"> Developed by Kuldeep Dhaka</i></span>
    </div>
    <div class="footer-right">
        <a href="https://www.instagram.com/kuldeep_dhaka911/"><i class="fab fa-instagram"></i></a>
        <a href="https://www.facebook.com/kuldeep.dhaka.148"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.linkedin.com/in/kuldeep-dhaka-3a6451150/"><i class="fab fa-linkedin-in"></i></a>
    </div>
</div></body>
</html>
