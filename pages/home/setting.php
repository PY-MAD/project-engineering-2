<?php
$titlePage = "Setting";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/checkLogged.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $vol = $_POST["vol"];
    $mysqli->query("UPDATE users SET volumeAudio = $vol where id = ".$_SESSION["userId"]);
    $_SESSION["vol"] = $vol;
}
?>
<link rel="stylesheet" href="../../css/index.css">
<link rel="stylesheet" href="../../css/home.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    *{
        font-family: "IBM Plex Sans Arabic";
    }
    .profile_pic{
        width: 100px;
        height: 100px;
        border-radius: 50px;
        border: 2px solid gray;
        background-image: url("../../assets/appBar/user.svg");
        background-repeat: no-repeat;
        background-position: center;
        background-color: #5BAAFF;
    }
    main{
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: start;
        height: 79.8vh;
    }
    input[type="range"]::-webkit-slider-runnable-track{
        background: #5BAAFF;
        border-radius: 12px;

    }
    .volume_text_style{
        font-weight: 600;
        color: #5BAAFF;
        font-size: 24px;
        display: flex;
    }
    .logout_btn{
        background-color: #5BAAFF;
        color: white !important;
        width: 60% !important;
        height: 50px !important;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 600;
        border-radius: 6px;
        border: 0;
        width: 100%;
    }
</style>
<div class="container">
    <!-- for the settings and profile if logged in -->
    <nav class="d-flex flex-row justify-content-end">
        <a href="" class="d-flex">
            <div class="circle-setting d-inline p-1 mx-3">
                <img src="<?php echo "../../assets/setting/setting.svg" ?>" alt="">
            </div>
        </a>
        <a href="" class="d-flex">
            <div class="circle-setting d-inline p-1">
                <img src="<?php echo "../../assets/setting/user.svg" ?>" alt="">
            </div>
        </a>
    </nav>
    <!-- main -->
    <main>
        <form action="" method="post" class="form-group w-100 d-flex flex-column justify-content-center align-items-center">
            <div class="volume w-100">
                <div class="volume_text_style">volume: <span id="text_value"><?php echo $_SESSION["vol"] ?></span>%</div>
                <input id="volume_btn" type="range" id="vol" name="vol" value="<?php echo $_SESSION["vol"] ?>" min="0" max="100" style="width : 100%;">
            </div>
            <div class="btn w-100 d-flex justify-content-center">
                <input type="submit" class="logout_btn mt-5" value="save the volume !">
            </div>
        </form>
    </main>

</div>
<?php include_once "appBar.php" ?>

<script>
    let volume =document.getElementById("volume_btn");
    let text_value =document.getElementById("text_value")
    volume.addEventListener('input',(input)=>{
            text_value.textContent =input.target.value;
    })

</script>


