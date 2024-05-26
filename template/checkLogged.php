<?php
session_start();
if( !isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false){
    header("Location:/project_eng_2/pages/auth/login.php");
}
