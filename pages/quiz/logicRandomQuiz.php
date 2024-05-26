<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selectedAnswer = $_POST['selectedAnswer'];
    $correctAnswer = $_POST['correctAnswer'];
    
    $response = [
        'status' => 'error',
        'message' => 'Invalid request'
    ];

    if (trim($selectedAnswer) == trim($correctAnswer)) {
        if (isset($_SESSION["temp_score_rank"])) {
            $_SESSION["temp_score_rank"] += 10;
        }
        
        $response['status'] = 'success';
        $response['newScore'] = $_SESSION["temp_score_rank"];
    } else {
        $response['status'] = 'failure';
        $_SESSION["random_trying"] = $_SESSION["random_trying"] - 1;
    }

    // Increment question number
    if (isset($_SESSION["question_num"])) {
        $_SESSION["question_num"]++;
    } else {
        $_SESSION["question_num"] = 1;
    }
    $response['nextQuestion'] = $_SESSION["question_num"];
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>