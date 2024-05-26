<?php
$titlePage = "Home";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/checkLogged.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";
$_SESSION["temp_score"] = 0;
$_SESSION["question_num"] = 0;

function getUserWait(){
    $mysqli = $GLOBALS["mysqli"];
    $flag = false;
    $date = $mysqli->query("SELECT * from wating_list_rank where user_id=".$_SESSION["userId"]);
    $today = date("Y-m-d H:i:s");
    if($date->num_rows > 0){
        $row = $date->fetch_array();
        $wating_date = $row["wating_date"];
        if($today >= $wating_date){
            $mysqli->query("DELETE FROM wating_list_rank where user_id=".$_SESSION["userId"]);
            $flag = true;
        }else{
            $flag = false;
            $_SESSION["random_trying"] = 3;
        }
    }else{
        $flag = false;
        $_SESSION["random_trying"] = 3;
    }
    return $flag;
}
?>
<link rel="stylesheet" href="../../css/index.css">
<link rel="stylesheet" href="../../css/home.css">
<style>
    .dark{
        position: relative;
    }
    .dark::before{
        content: "come tomorrow";
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 28px;
        background-color: black;
        z-index: 100;
        position: absolute;
        left: 0;
        top:0;
        height: 100%;
        width: 100%;
        border-radius: 24px;
        opacity: 0.7;
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
        <div class="title">
            Choose the mood
        </div>
        <div class="cards mt-5">
            <a href="../typeMood/Educational.php" class="mb-5">
                <div class="card_mood books">
                    <div class="text_card">
                        Educational
                    </div>
                    <div class="image">
                        <img src="../../assets/home/books.svg" alt="">
                    </div>
                </div>
            </a>
            <?php if(!getUserWait()): ?>
            <a href="../quiz/randomQuiz.php?question=0" class="mb-5">
                <div class="card_mood clock">
                    <div class="text_card">
                        Random game
                    </div>
                    <div class="image">
                        <img src="../../assets/home/clock.svg" alt="">
                    </div>
                </div>
            </a>
            <?php else: ?>
            <div class="mb-5 dark">
                <div class="card_mood clock">
                    <div class="text_card">
                        Random game
                    </div>
                    <div class="image">
                        <img src="../../assets/home/clock.svg" alt="">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <a href="../typeMood/custom_game.php" class="mb-5">
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
    </main>
</div>
<?php include_once "appBar.php" ?>