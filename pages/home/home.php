<?php 
$titlePage = "Home";
include_once $_SERVER['DOCUMENT_ROOT']."/project_eng_2/template/navBar.php";

?>
<link rel="stylesheet" href="../../css/index.css">
<link rel="stylesheet" href="../../css/home.css">
<div class="container">
            <!-- for the settings and profile if logged in -->
            <nav class="d-flex flex-row justify-content-end">
                <a href="" class="d-flex">
                <div class="circle-setting d-inline p-1 mx-3">
                    <img src="<?php echo "../../assets/setting/setting.svg"?>" alt="">
                </div>
                </a>
                <a href="" class="d-flex">
                <div class="circle-setting d-inline p-1">
                    <img src="<?php echo "../../assets/setting/user.svg"?>" alt="">
                </div>
                </a>
            </nav>
            <!-- main -->
            <main>
                <div class="title">
                    Choose the mood
                </div>
                <div class="cards mt-5">
                    <a href="" class="mb-5">
                        <div class="card_mood books">
                            <div class="text_card">
                                Educational
                            </div>
                            <div class="image">
                                <img src="../../assets/home/books.svg" alt="">
                            </div>
                        </div>
                    </a>
                    <a href="" class="mb-5">
                        <div class="card_mood clock">
                            <div class="text_card">
                                Random game
                            </div>
                            <div class="image">
                                <img src="../../assets/home/clock.svg" alt="">
                            </div>
                        </div>
                    </a>
                    <a href="" class="mb-5">
                        <div class="card_mood cus_game">
                            <div class="text_card">
                                custom game
                            </div>
                            <div class="image">
                                <img src="../../assets/home/humen_custom.svg" alt="">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="appBar">
                    <a href="">
                        <img src="../../assets/appBar/setting.svg" alt="">
                    </a>
                    <a href="">
                        <img src="../../assets/appBar/ranking.svg" alt="">
                    </a>
                    <a href="">
                        <img src="../../assets/appBar/play.svg" alt="">
                    </a>
                    <a href="">
                        <img src="../../assets/appBar/user.svg" alt="">
                    </a>
                </div>
            </main>
</div>