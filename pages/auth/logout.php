<?php

    session_start();
    if(isset($_SESSION["logged_in"])){
    $_SESSION = [];
    $_SESSION["welcome_message"] = "logged out is success !!!";
        }
header("location: ../../index.php");
die();