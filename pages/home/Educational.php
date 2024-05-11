<?php
$titlePage = "Educational";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";

?>
<link rel="stylesheet" href="../../css/index.css">
<link rel="stylesheet" href="../../css/home.css">
<link rel="stylesheet" href="../../css/levels.css">

<style>
    @media screen and (max-width: 430px) {
    nav {
        display: flex;
        flex-direction: row-reverse;
        justify-content: space-between;
    }
}
</style>
<div class="container">
    <!-- for the settings and profile if logged in -->
    <nav class="d-flex ">
        <div class="right d-flex flex-row justify-content-end">
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
        </div>
        <div class="left d-flex flex-row justify-content-start">
        <a href="" class="d-flex">
            <div class="circle-setting d-inline p-1">
                <img src="<?php echo "../../assets/back.svg" ?>" alt="">
            </div>
        </a>
        </div>
    </nav>
    <!-- main -->
    <main>
        <div class="title">
            Let's play
        </div>
        <div class="under-title opacity-50">
            BE THE FIRST
        </div>
        <div class="cards mt-5">
            <a href="../quiz/quiz.php?learning=1" class="mb-5">
                <div class="card_mood books p-3">
                    <div class="right_cards">
                        <div class="image-level">
                            <img src="../../assets/levels_image/english.svg" alt="">
                        </div>
                    </div>
                    <div class="left_cards">
                        <div class="image">
                                <img src="../../assets/levels/done.svg" alt="">
                        </div>    
                        <div class="texts">
                            <div class="text_level text_card">
                                level 1
                            </div>
                            <div class="text_card">
                                Travel English
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </main>
</div>