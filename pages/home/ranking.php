<?php
$titlePage = "Home";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/checkLogged.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";

$typeOfMood = $_GET["ranking_type"];

if($typeOfMood == "educational"){
    $typeOfMood = "edu_rank";
}elseif($typeOfMood == "random"){
    $typeOfMood = "random_rank";
}
$q = $mysqli->query("SELECT $typeOfMood.score , users.name FROM $typeOfMood , users where user_id = users.id");
$users = $q->fetch_all(MYSQLI_ASSOC);

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
            <?php if($typeOfMood == "edu_rank"): ?>
                <a class="active" href="?ranking_type=educational">educational</a>
            <?php else: ?>
                <a class="" href="?ranking_type=educational">educational</a>
            <?php endif ?>
            <?php if($typeOfMood == "random_rank"): ?>
                <a class="active" href="?ranking_type=random">random</a>
            <?php else: ?>
                <a class="" href="?ranking_type=random">random</a>
            <?php endif ?>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Name</th>
                    <th scope="col">Score</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 0;
                foreach($users as $user): ?>
                <tr>
                    <th scope="row"><?php echo  ++$i ?></th>
                    <td><?php echo $user["name"] ?></td>
                    <td><?php echo  $user["score"] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>
<?php include_once "appBar.php" ?>
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