<?php
$titlePage = "Setting";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";

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
        <div class="volume_text_style">volume: <span id="text_value">100</span>%</div>
        <input id="volume_btn" type="range" id="vol" name="vol" value="100" min="0" max="100" style="width : 100%;">
    </main>

</div>
<div class="appBar">
    <div class="cards-appBar">
        <a href="setting.php">
            <img class="white" src="../../assets/appBar/setting.svg" alt="">
        </a>
        <a href="ranking.php?ranking_type=educational"  style="margin-bottom: 15px;">
            <img class="white"src="../../assets/appBar/ranking.svg" alt="">
        </a>
        <a href="home.php">
            <img class="white" src="../../assets/appBar/play.svg" alt="">
        </a>
        <a href="user.php">
            <img class="white" src="../../assets/appBar/user.svg" alt="">
        </a>
    </div>
</div>

<script>
    let volume =document.getElementById("volume_btn");
    let text_value =document.getElementById("text_value")
    volume.addEventListener('input',(input)=>{
            text_value.textContent =input.target.value;
    })

</script>