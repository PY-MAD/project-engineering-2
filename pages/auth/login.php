<?php 
$titlePage = "Login";
include_once $_SERVER['DOCUMENT_ROOT']."/project_eng_2/template/navBar.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";
$err = [];
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!empty($_POST["email"])){
            $email = mysqli_escape_string($mysqli, $_POST["email"]);
        }else{
            array_push($err,"email is empty");
        }
        if(!empty($_POST["password"])){
            $password = mysqli_escape_string($mysqli, $_POST["password"]);
        }else{
            array_push($err,"password is empty");
        }
        $checkEmail = $mysqli->query("SELECT password from users where email = '$email'");
        if($checkEmail->num_rows){
            $checkPassword = $mysqli->query("SELECT password from users where email = '$email'")->fetch_assoc()["password"];
            $check = password_verify($password, $checkPassword);
            if($check){
                session_start();
                $getUser = $mysqli->query("SELECT email , name, score, id, volumeAudio from users where email = '$email' ")->fetch_assoc();
                $name = $getUser["name"];
                $email = $getUser["email"];
                $score = $getUser["score"];
                $userId = $getUser["id"];
                $vol = $getUser["volumeAudio"];
                $getRankScore = $mysqli->query("SELECT score as RRS FROM random_rank where user_id = $userId limit 1")->fetch_assoc();
                $getRankScoreLearning = $mysqli->query("SELECT score as ERS FROM edu_rank where user_id = $userId limit 1")->fetch_assoc();
                $_SESSION["name"] = $name;
                $_SESSION["email"] = $email;
                $_SESSION["score"] = $score;
                $_SESSION["random_score"] = $getRankScore["RRS"];
                $_SESSION["edu_score"] = $getRankScoreLearning["ERS"];
                $_SESSION["temp_score"] = 0;
                $_SESSION["temp_score_rank"] = 0;
                $_SESSION["userId"] = $userId;
                $_SESSION["vol"] = $vol;
                $_SESSION["random_trying"] = 3;
                $_SESSION["logged_in"] = true;
                header("location: ../home/home.php");
            }else{
                array_push($err, "the email or password is incorrect");
            }
        }else{
            array_push($err, "the user not't register yet !");
        }
        
    }
?>
<link rel="stylesheet" href="../../css/auth.css">
<body>
    <div class="container_bg">
        <div class="from_group w-100 d-flex flex-column justify-content-center align-items-center">
            <div class="logo mb-5">
                <img src="../../assets/logos/appLogo.png" alt="" width="300px">
            </div>
            <?php if($err): ?>
                <div class="alert alert-danger w-75">   
                    <ul>
                        <?php foreach($err as $errorMsg):?>
                            <li><?php echo $errorMsg; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            <form action="" method="post" class="d-flex form-group flex-column justify-content-center w-100">
                <div class="form-group m-auto mb-3">
                    <input required type="email" name="email" id="login_Email" placeholder="EMAIL" class="form-control fs-5 p-3">
                </div>
                <div class="form-group m-auto mb-3">
                    <input required type="password" name="password" id="login_password" placeholder="PASSWORD" class="form-control fs-5 p-3">
                </div>
                <a class="text-white forget_password mb-3">Forget Password</a>
                <div class="form-group m-auto  mb-3">
                    <input required type="submit" value="Login" class="btn btn-primary btn-lg btn-Login-color text-white">
                </div>
                <div class="text-white text-center mt-3 mb-2">if don't have account Join to us now !</div>
                <a href="register.php" class="w-100 d-flex flex-column justify-content-center align-items-center">
                <div class="form-group m-auto  mb-3">
                    <a href="register.php"  class="btn btn-primary btn-lg btn-Register-color text-white">Register</a>
                </div>
                </a>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>
<script>
    localStorage.setItem("life", 3);
</script>