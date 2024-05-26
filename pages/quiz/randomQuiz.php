<?php
$titlePage = "rank quiz";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/checkLogged.php";
$userId = $_SESSION["userId"];
if($_GET["question"] == 10){
    $score = $_SESSION["random_score"] + $_SESSION["temp_score_rank"];
    $mysqli->query("UPDATE random_rank SET score = $score where user_id = $userId");
    $mysqli->query("INSERT INTO wating_list_rank VALUES($userId,NOW())");
    header("location: ../home/home.php");
    exit;
}
if($_SESSION["random_trying"] == 0){
    $mysqli->query("INSERT INTO wating_list_rank VALUES($userId,NOW())");
    header("location: loser.php");
    exit;
}


$q = $mysqli->query("SELECT DISTINCT (question), correct_answer, wrong_answer1, wrong_answer2, wrong_answer3 FROM random_q ORDER BY RAND()  limit 10");
// Fetching questions

$question = "";
$answers = [];
$question_num = (int)$_GET["question"];
$progress_bar = ($question_num/$q->num_rows)*100;
if ($q && $q->num_rows > 0) {
    $row = $q->fetch_all(MYSQLI_ASSOC);
    $question = $row[$question_num]["question"];
    $answers = [
        $row[$question_num]["correct_answer"],
        $row[$question_num]["wrong_answer1"],
        $row[$question_num]["wrong_answer2"],
        $row[$question_num]["wrong_answer3"]
    ];
    shuffle($answers); // Randomize answers
} else {
    echo "No rows found.";
    exit;
}
$correct_answer_db = $row[$question_num]['correct_answer'];
echo "<script> let correct_answer = '$correct_answer_db';</script>";
// Check if a form was submitted
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titlePage; ?></title>
    <link rel="stylesheet" href="../../css/auth.css">
    <!-- Existing CSS and Google Fonts links -->
</head>
<style>
    @media screen and (max-width: 430px) {

        .container_bg {
            background: white;
            padding: 20px;
            width: 100%;
            display: block;
        }

        .score {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 20px;
            color: #000;
        }

        .progress {
            background-color: #ddd;
            border-radius: 8px;
            overflow: hidden;
            width: 100%;
            margin-top: 20px;
        }

        .progress-bar {
            height: 20px;
            background-color: #28A745;
            width: 0%;
        }

        .question {
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        .options form {
            display: flex;
            flex-direction: column;
        }

        .answer_label {
            margin-bottom: 10px;
            background: #f8f8f8;
            padding: 10px;
            border-radius: 20px;
            /* More rounded edges for answer buttons */
            display: flex;
            justify-content: center;
            /* Center the radio buttons and labels */
            background-color: white;
            color: black;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
        }
        .answer_choose {
            margin-bottom: 10px;
            background: #f8f8f8;
            padding: 10px;
            border-radius: 20px;
            /* More rounded edges for answer buttons */
            display: flex;
            justify-content: center;
            /* Center the radio buttons and labels */
            background: rgb(63,94,251);
            background: linear-gradient(208deg, rgba(63,94,251,1) 0%, rgba(254,0,248,1) 100%);
            color: white;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
        }

        .answer label {
            display: block;
            width: 100%;
        }

        .option {
            margin-left: 10px;
            cursor: pointer;
        }

        button.btn {
            padding: 10px 20px;
            font-size: 1em;
            color: white;
            background-color: #0056b3;
            /* Adjusted to match the button color */
            border: none;
            border-radius: 20px;
            /* More rounded edges for the submit button */
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
            /* Match the design */
        }

        button.btn:hover {
            background-color: #004085;
        }
        .red{
            background-color: #C82F2F !important;
            color: white;
        }
        .green{
            background-color: #3AC540 !important;
            color:white;
        }
        .question{
            font-size: 60px;
            font-weight: 800;
            text-align: center;
            color: white;
            margin-top: 100px;
        }
        .score{
            font-size: 30px;
            color: white;
            font-weight: 600;
        }
        .heart{
            /* filter: brightness(0) saturate(100%) invert(100%) sepia(0%) saturate(20%) hue-rotate(310deg) brightness(106%) contrast(104%); */
        }
        .heart_animation{
            animation-name: heart;
            animation-duration: 1s;
            animation-iteration-count: infinite;
        }
        @keyframes heart {
            0%{
                opacity: 1;
            }50%{
                opacity: 0;
            }%100{
                opacity: 1;
            }
        }
    }
</style>

<body>

    <div class="container_bg">
        <div class="topBar d-flex justify-content-between">
            <div class="score">score : <span class="score_num"><?php echo $_SESSION["temp_score_rank"]; ?></span></div>
            <div class="chance" id="chance">
                
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar" style="width:<?php echo $progress_bar ?>%"></div>
        </div>
        <div class="question"><?php echo $question; ?></div>
        <div class="options">
            <form action="" id="quiz-form" method="post">
                <?php foreach ($answers as $answer): ?>
                    <div class="answer">
                        <label class="answer_label" data-answer="<?php echo $answer ;?>" for="<?php echo $answer; ?>">
                            <?php echo $answer; ?>
                        </label>
                        <input type="radio" class="option" name="answer" hidden value="<?php echo $answer; ?>" id="<?php echo $answer; ?>">
                    </div>
                <?php endforeach; ?>
                <button id="submit" type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>
<audio src="../../assets/soundEffects/CorrectAnswer.mp3" id="correctAnswerEffect"></audio>
<audio src="../../assets/soundEffects/WrongAnswer.mp3" id="WrongAnswerEffect"></audio>
</html>
<script>

    let chance_container =document.getElementById("chance");
    let chance = <?php echo $_SESSION["random_trying"] ?>;
    let heart_img = "<img src='../../assets/chanceGame/lifeChance.svg' width='50px' class='heart' alt=''>"
    for(let i = 0; i<chance; i++){
        chance_container.innerHTML+=heart_img;
        if(chance == 1){
            document.querySelector("#chance img").classList.add("heart_animation");
        }
    }

document.addEventListener('DOMContentLoaded', () => {
    let checked = document.querySelectorAll(".answer_label");
    checked.forEach((item) => {
        item.addEventListener("click", () => {
            if (!item.classList.contains("answer_choose")) {
                item.classList.add("answer_choose");
                item.id = "choose_answer";
                item.classList.remove("answer");
                checked.forEach((item2) => {
                    if (item2 != item) {
                        item2.classList.remove("answer_choose");
                        item.classList.add("answer");
                        item2.id = "";
                    }
                });
            }
        });
    });

    let submit = document.getElementById("submit");
    submit.addEventListener("click", (event) => {
        event.preventDefault(); // Prevent the form from submitting normally
        let answer = document.getElementById("choose_answer");
        let score_num = document.querySelector(".score_num");
        let choose_answer = answer.getAttribute("data-answer");
        
        if (answer.getAttribute("data-answer") == correct_answer) {
            answer.classList.add("green");
            let currentScore = parseInt(score_num.textContent);
            let newScore = currentScore + 10;
            animateScoreIncrement(currentScore, newScore, score_num, () => {
                score_num.innerHTML = newScore;
            });
            correctAnswer();
        } else {
            answer.classList.add("red");
            WrongAnswer();
        }

        answer.classList.remove("answer_choose");
        answer.classList.remove("answer");
        checkAnswer(choose_answer, correct_answer);
    });

    function correctAnswer() {
        document.getElementById("correctAnswerEffect").play();
    }

    function WrongAnswer() {
        document.getElementById("WrongAnswerEffect").play();
    }

    function animateScoreIncrement(start, end, score_num, callback) {
        let score = start;
        let increment = 1; // Change this value to adjust the increment speed
        let animationInterval = setInterval(function () {
            score += increment;
            score_num.innerHTML = score;
            if (score >= end) {
                clearInterval(animationInterval);
                callback(); // Call the callback function once the animation is complete
            }
        }, 50); // Change this value to adjust the animation speed (milliseconds per frame)
    }

    function checkAnswer(select, correct) {
        let formData = new FormData();
        formData.append("selectedAnswer", select);
        formData.append("correctAnswer", correct);

        let http = new XMLHttpRequest();
        let url = "http://localhost:8012/project_eng_2/pages/quiz/logicRandomQuiz.php";
        http.open('POST', url, true);
        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                let response = JSON.parse(http.responseText);
                if (response.status === 'success') {
                    console.log('Answer was correct');
                } else {
                    console.log('Answer was incorrect');
                }

                // Redirect to the next question or finish the quiz
                window.location.href = `randomQuiz.php?question=${response.nextQuestion}`;
            } else if (http.readyState == 4) {
                console.log("Error:", http.status, http.statusText);
            }
        };
        http.send(formData);
    }
});
</script>