<?php
$titlePage = "Home";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";

?>
<link rel="stylesheet" href="../../css/index.css">
<link rel="stylesheet" href="../../css/home.css">
<style>
    main{
        height: 79.7vh;
    }
    .topBar{
        margin-top: 30px;
        display: flex;
        justify-content: space-around;
    }
    .topBar a{
        background-color: #5BAAFF;
        color: white !important;
        padding: 10px 16px;
        border-radius: 12px;
    }
    .topBar .active{
        background-color: #f9690e !important;
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
        <div class="topBar">
            <a class="active">educational</a>
            <a class="">random</a>
            <a class="">costume</a>
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
<script>
    let ranking_type = document.querySelectorAll(".topBar a");
    ranking_type.forEach((item)=>{
        item.addEventListener(("click"),()=>{
            ranking_type.forEach((item)=>{
                item.classList.remove("active");
            })
            item.classList.add("active");
        })
    })
</script>