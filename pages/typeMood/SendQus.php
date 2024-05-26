<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/checkLogged.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $q = mysqli_real_escape_string($mysqli, $_POST["question"]);
    $a = mysqli_real_escape_string($mysqli, $_POST["correctAnswer"]);
    $w1 = mysqli_real_escape_string($mysqli, $_POST["wrongAnswer1"]);
    $w2 = mysqli_real_escape_string($mysqli, $_POST["wrongAnswer2"]);
    $w3 = mysqli_real_escape_string($mysqli, $_POST["wrongAnswer3"]);
    $token = $_SESSION["lastQuiz"];

    // Debugging: Print the session variable to ensure it's set
    if (empty($token)) {
        die('Error: Session variable "lastQuiz" is not set.');
    }

    $stmt = $mysqli->prepare("INSERT INTO q_custom (quiz_id, question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssss", $token, $q, $a, $w1, $w2, $w3);
    if ($stmt->execute()) {
        echo "Question and answers successfully inserted.";
    } else {
        echo "Execute failed: " . $stmt->error;
    }

    $stmt->close();

    header("location: custom_game.php");
    exit();
}

?>