<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $token = $_POST["token"];
    $user = $_POST["userId"];
    $mysqli->query("DELETE FROM coustom_game where user_id = '$user' AND quiz_id = '$token' ");
}