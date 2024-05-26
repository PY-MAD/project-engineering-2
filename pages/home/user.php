<?php
$titlePage = "Home";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/checkLogged.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";
$user = $_SESSION["userId"];
$custom_games = $mysqli->query("SELECT CG.* , CG.name as quiz_name FROM coustom_game AS CG where user_id = $user");
$num = $custom_games->num_rows;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = mysqli_escape_string($mysqli, $_POST["name"]);
    $email = mysqli_escape_string($mysqli, $_POST["email"]);

    if ($name != $_SESSION["name"] || $email != $_SESSION["email"]) {
        $mysqli->query("UPDATE users SET name = '$name' , email = '$email' where id = " . $_SESSION["userId"]);
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
    }
    header("location: user.php");
    exit();
}
?>
<link rel="stylesheet" href="../../css/index.css">
<link rel="stylesheet" href="../../css/home.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
    rel="stylesheet">
<style>
    * {
        font-family: "IBM Plex Sans Arabic";
    }

    .profile_pic {
        width: 100px;
        height: 100px;
        border-radius: 50px;
        border: 2px solid gray;
        background-image: url("../../assets/appBar/user.svg");
        background-repeat: no-repeat;
        background-position: center;
        background-color: #5BAAFF;
    }

    main {
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: center;
        height: 79.8vh;
    }

    .name,
    .email {
        color: #5BAAFF;
        font-size: 32px;
        font-weight: 600;
        margin: 10px 0px;
    }

    .logout_btn {
        background-color: #C82F2F;
        color: white !important;
        width: 60% !important;
        height: 50px !important;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 600;
        border-radius: 6px;
        border: 0;
    }

    .logout_btn {
        margin-top: 12px;
    }

    .info {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .change_info {
        margin-top: 70px;
        background-color: #5BAAFF;
    }

    .custom_games {
        width: 100%;
    }

    .title_games {
        width: 100%;
        font-size: 24px;
        text-align: start;
        margin-top: 24px;
        font-weight: bold;
    }

    .background_games {
        background: linear-gradient(45deg, #BB1900, #FD6F01, #FFB000);
        color: white;
        border-radius: 16px 16px 0px 0px;
    }

    .custom_games {
        overflow: scroll;
        max-height: 200px;
    }

    body {
        overflow: hidden;
    }

    .info_create {
        font-size: 12px;
    }

    .img {
        width: 150px;
        height: 100px;
        background-position: center;
        background-size: cover;
        margin-right: 2rem;
        border-radius: 12px;
    }

    .card-title {
        font-size: 0.83em;
    }

    .card-text,
    p {
        font-size: 0.70em;
    }
    .delete_icon{
        background-color: red;
        border-radius: 0 0px 16px 16px;
        padding: 16px 0px;
        width: 100%;
        color: white;
        font-weight: bold;
        text-align: center;
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
        <form class="info mt-5 w-75" method="POST">
            <?php if (isset($_GET["editMood"])):
                $edit = ""; ?>
            <?php else:
                $edit = "disabled"; ?>
            <?php endif; ?>
            <div class="name">
                <input class="form-control" type="text" name="name" id="name" <?php echo $edit ?>
                    value="<?php echo $_SESSION["name"] ?>">
            </div>
            <div class="email">
                <input class="form-control" type="text" name="email" id="email" <?php echo $edit ?>
                    value="<?php echo $_SESSION["email"] ?>">
            </div>
            <div class="title_games">your games</div>
            <div class="custom_games mt-2 w-100 p-3" id="container_quiz">
                <?php foreach ($custom_games as $game): ?>
                    <a id="custom_token=<?php echo $game["quiz_id"] ?>" href="../quiz/quiz.php?custom&token=<?php echo $game["quiz_id"]?>&question=0" class="card background_games d-flex w-100 mt-3" style="z-index=1">
                        <div class="card-body d-flex align-items-center">
                            <div class="img" style="background-image: url(<?php echo $game["image_url"] ?>);"></div>
                            <div class="info">
                                <h5 class="card-title"><?php echo $game["quiz_name"] ?></h5>
                                <p class="card-text "><?php echo $game["description"] ?></p>
                                <div class="info_create d-flex flex-column-reverse ">
                                    <p style="margin-bottom : 0 !important;">created at : <?php echo $game["created_at"] ?>
                                    </p>
                                    <p style="margin-top : 1rem; margin-bottom : 0 !important;">by
                                        <?php echo $_SESSION["name"] ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="delete_icon token_=<?php echo $game["quiz_id"] ?>"
                        token_data="<?php echo $game["quiz_id"] ?>" id="delete_btn=<?php echo $game["quiz_id"] ?>">
                        Delete quiz
                    </div>
                <?php endforeach; ?>
                <?php if (!$num): ?>
                    <div>there no games</div>
                <?php endif; ?>
            </div>
            <?php if (isset($_GET["editMood"])): ?>
                <input type="submit" value="save update !" class="logout_btn change_info">
            </form>

        <?php else: ?>
            <a class="logout_btn change_info" href="?editMood">
                change data
            </a>
            <a class="logout_btn" href="../auth/logout.php">
                Logout
            </a>
        <?php endif; ?>
    </main>

</div>

<script>
    let container = document.getElementById("container_quiz");
    let deleteBtns = document.querySelectorAll(".delete_icon");
    deleteBtns.forEach((item) => {
        item.addEventListener("click", () => {
            let token = item.getAttribute("token_data");
            let formData = new FormData();
            formData.append("token", token);
            formData.append("userId", <?php echo $_SESSION["userId"] ?>);

            let http = new XMLHttpRequest();
            let url = "http://localhost:8012/project_eng_2/pages/delete/deleteQuiz.php";
            http.open('POST', url, true);
            http.onreadystatechange = function () {
                if (http.readyState == 4 && http.status == 200) {
                    console.log(http.responseText);
                } else if (http.readyState == 4) {
                    console.log("Error:", http.status, http.statusText);
                }
            };
            http.send(formData);
            let child = document.getElementById(`custom_token=${token}`);
            let childBtn =document.getElementById(`delete_btn=${token}`);
            container.removeChild(child);
            container.removeChild(childBtn);

        })
    })
</script>
<?php include_once "appBar.php" ?>