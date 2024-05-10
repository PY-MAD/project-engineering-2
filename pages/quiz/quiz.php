<?php
$titlePage = "quiz" . $_GET["learning"];
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";

// Fetching questions
$q = $mysqli->query("SELECT question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3 FROM learning WHERE level = 1 ORDER BY RAND() LIMIT 1");

$question = "";
$answers = [];

if ($q && $q->num_rows > 0) {
    $row = $q->fetch_assoc();
    $question = $row["question"];
    $answers = [
        $row["correct_answer"],
        $row["wrong_answer1"],
        $row["wrong_answer2"],
        $row["wrong_answer3"]
    ];
    shuffle($answers); // Randomize answers
} else {
    echo "No rows found.";
    exit;
}

// Check if a form was submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $selected_answer = $_POST['answer'];
    $correct_answer = $row["correct_answer"];
    if ($selected_answer == $correct_answer) {
        echo "<script>alert('Correct answer!');</script>";
    } else {
        echo "<script>alert('Wrong answer! The correct answer was: $correct_answer');</script>";
    }
}
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

        .answer {
            margin-bottom: 10px;
            background: #f8f8f8;
            padding: 10px;
            border-radius: 20px;
            /* More rounded edges for answer buttons */
            display: flex;
            justify-content: center;
            /* Center the radio buttons and labels */
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
            background-color: #C82F2F;
        }
        .green{
            background-color: #3AC540;
        }
    }
</style>

<body>
    <div class="container_bg">
        <div class="score">score : 250</div>
        <div class="progress">
            <div class="progress-bar" style="width:0%"></div>
        </div>
        <div class="question"><?php echo $question; ?></div>
        <div class="options">
            <form action="" id="quiz-form" method="post">
                <?php foreach ($answers as $answer): ?>
                    <div class="answer">
                        <label class="">
                            <?php echo $answer; ?>
                        </label>
                        <input type="radio" class="option" name="answer" hidden value="<?php echo $answer; ?>">
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>