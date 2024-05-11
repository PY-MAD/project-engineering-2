<?php
$titlePage = "Home";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";
session_start();
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
        align-items: center;
        height: 79.8vh;
    }
    .name, .email{
        color: #5BAAFF;
        font-size: 32px;
        font-weight: 600;
        margin: 10px 0px;
    }
    .logout_btn a{
        background-color: #C82F2F;
        color: white !important;
        width: 120px !important;
        height: 30px !important;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 600;
        border-radius: 6px;
    }
    .logout_btn{
        position: absolute;
        bottom: 18vh;
    }
    .info{
        display: flex;
        flex-direction: column;
        align-items: end;
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
        <div class="profile_pic"></div>
        <div class="info">
            <div class="name">
                <?php echo $_SESSION["name"] ?>
            </div>
            <div class="email">
            <?php echo $_SESSION["email"] ?>
            </div>
        </div>
        <div class="logout_btn">
            <a src="">Logout</a>
        </div>
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