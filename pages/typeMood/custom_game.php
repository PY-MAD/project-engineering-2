<?php
$titlePage = "Custom game";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/checkLogged.php";

$custom_games = $mysqli->query("SELECT CG.name as quiz_name , CG.* , users.name FROM coustom_game AS CG , users where user_id = users.id")->fetch_all(MYSQLI_ASSOC);

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
        .background_games {
            background: linear-gradient(45deg, #BB1900, #FD6F01, #FFB000);
            color: white;
        }
        .info_create{
            font-size: 12px;
        }
        .img{
            width: 150px;
            background-position: center;
            background-size: cover;
            margin-right: 2rem;
            border-radius: 12px;
            height: auto;
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
        <a href="add_game.php" class="card background_games d-flex w-100 mt-3">
            <div class="card-body">
                <h5 class="card-title text-center">Create your game !</h5>
            </div>
        </a>
        <hr>
        <input type="text" class="form-control" name="search" id="search" placeholder="search a game or add @ to search by user">

        <div id="cards">
        <?php foreach($custom_games as $game):?>
            <a href="../quiz/quiz.php?custom&token=<?php echo $game['quiz_id']?>&question=0" class="card background_games d-flex w-100 mt-3">
                <div class="card-body d-flex">
                    <div class="img" style="background-image: url(<?php echo $game["image_url"] ?>);"></div>
                    <div class="info">
                            <h5 class="card-title"><?php echo $game["quiz_name"] ?></h5>
                            <p class="card-text "><?php echo $game["description"] ?></p>
                            <div class="info_create d-flex flex-column-reverse ">
                                <p style="margin-bottom : 0 !important;">created at : <?php echo $game["created_at"] ?> </p>
                                <p class="user" style="margin-top : 1rem; margin-bottom : 0 !important;">by <?php echo $game["name"] ?></p>
                            </div>    
                    </div>
                </div>
            </a>
            <?php endforeach;?>
        </div>
    </main>
<script>
    let searchInput =document.getElementById("search");
    searchInput.addEventListener('keyup',()=>{
        let input , filter , container , card,a, txtValue;
        input =document.getElementById("search");
        filter = input.value.toUpperCase();
        container = document.getElementById("cards");
        card =  container.getElementsByTagName("a");
        if(input.value[0] == "@"){
                let newFilter =filter.slice(1,filter.length);
                console.log(newFilter);
                for(let i = 0 ; i<card.length; i++){
                a = card[i].querySelector(".user");
                txtValue = a.textContent || a.innerText;
                textValue = txtValue.slice(2, txtValue.length);
                if(txtValue.toUpperCase().indexOf(newFilter) > -1){
                    card[i].style.display = "";
                    card[i].classList.add("d-flex");
                }else{
                    card[i].style.display = "none";
                    card[i].classList.remove("d-flex");
                }
            }
        }else{
            for(let i = 0 ; i<card.length; i++){
            a = card[i].querySelector(".card-title");
            txtValue = a.textContent || a.innerText;
            if(txtValue.toUpperCase().indexOf(filter) > -1){
                card[i].style.display = "";
                card[i].classList.add("d-flex");
            }else{
                card[i].style.display = "none";
                card[i].classList.remove("d-flex");
            }
        }
        }
    })
</script>