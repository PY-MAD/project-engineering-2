<?php
$titlePage = "Educational";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/checkLogged.php";
$_SESSION["temp_score"] = 0;
$cards = $mysqli->query("SELECT * FROM levels_learning");
$cards = $cards->fetch_all(MYSQLI_ASSOC);

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
        <a href="../home/home.php" class="d-flex">
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
        <?php foreach($cards as $card): ?>
            <div class="cards mt-5">
            <?php
            $done_sub = $mysqli->query("SELECT * FROM learning_edu_done 
                            where user_id = '" . $_SESSION["userId"] . "' 
                            AND learning_id = '" . $card["id"] . "'
                            LIMIT 1");
            if ($done_sub->num_rows) {
                $file = "done";
            } else {
                $check_sub_num = $card["id"] - 1;
                $check_sub = $mysqli->query("SELECT * FROM learning_edu_done where user_id = " . $_SESSION["userId"] . " AND learning_id = " . $check_sub_num . " limit 1 ");
                if ($check_sub->num_rows || $card["id"] == 1) {
                    $file = "start";
                } else {
                    $file = "locked";
                }
            }
            ?>
            <?php 
            $id = $card['id'];
            if($file == "start"){
                $start = "<a href='../quiz/quiz.php?learning=$id&question=0' class='mb-5'>";
                $end = "</a>";
            }else{
                $start = "<div href='../quiz/quiz.php?learning=$id&question=0' class='mb-5'>";
                $end = "</div>";
            }
            
            ?>
            <?php echo $start ;?>
                <div class="card_mood books p-3">
                    <div class="right_cards">
                        <div class="image-level">
                            <img src="../../assets/levels_image/english.svg" alt="">
                        </div>
                    </div>
                    <div class="left_cards">
                        <div class="image">
                                <img src="../../assets/levels/<?php echo $file ?>.svg" alt="">
                        </div>    
                        <div class="texts">
                            <div class="text_level text_card">
                                level <?php echo $card["id"]  ?>
                            </div>
                            <div class="text_card">
                            <?php echo $card["name"]  ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $end ;?>
        </div>
        <?php endforeach; ?>
    </main>
</div>