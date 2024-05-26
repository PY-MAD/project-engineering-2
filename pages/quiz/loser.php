<?php
$titlePage = "loser";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/checkLogged.php";
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

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
        body{
            overflow: hidden;
        }
        .container_bg {
            background : linear-gradient(180deg, rgba(46,147,255,1) 0%, rgb(18, 19, 19) 100%) !important;
            width: 100%;
            display: block;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .text{
            font-size: 30px;
            color: white;
            font-weight: bold;
            margin-bottom: 3rem;
            font-family: "Work Sans";
        }
        .pra{
            margin-bottom: 3rem;
        }
        .auto_play{
            border-radius: 16px;
            background-color: white;
            color: black;
            font-size: 24px;
            font-weight: bold;
            padding: 16px 24px;
        }
    }
</style>

<body class="container_bg">
    <div class="text">
        Hey , loser how are you ??
    </div>
    <div class="pra text">

    </div>
    <button id="auto_play" class="auto_play"> click here to go home page</button>

    <audio id="auto_play_sound" src="../../assets/soundEffects/loser.mp3" autoplay>
        <source src="../../assets/soundEffects.mp3" type="audio/mpeg">
    </audio>
</body>
</html>
<script>
    var audio = document.getElementById('auto_play');
    audio.addEventListener("click",()=>{
        document.querySelector("#auto_play_sound").play();
        document.querySelector(".pra").textContent = "it's okay, when be loser";
    })
    
    setTimeout(() => {
        window.location.href = "../home/home.php";
    }, 8000);

</script>