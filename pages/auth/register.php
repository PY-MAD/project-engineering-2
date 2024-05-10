<?php 
$titlePage = "Register";
include_once $_SERVER['DOCUMENT_ROOT']."/project_eng_2/template/navBar.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";

?>
<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = mysqli_escape_string($mysqli, $_POST["email"]);
        $name = mysqli_escape_string($mysqli, $_POST["name"]);
        $password = mysqli_escape_string($mysqli, $_POST["password"]);
        $conf_password = mysqli_escape_string($mysqli, $_POST["conf_password"]);
        if($password == $conf_password){
            $newPassword = password_hash($password, PASSWORD_DEFAULT);
            $mysqli->query("INSERT INTO users(email,name,password) VALUES 
            ('$email','$name','$newPassword')");
            header("location:../home/home.php");
            exit();
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
            <form action="" method="post" class="d-flex form-group flex-column justify-content-center w-100">
                <div class="form-group m-auto mb-3">
                    <input required type="email" name="email" id="login_Email" placeholder="EMAIL" class="form-control fs-5 p-3">
                </div>
                <div class="form-group m-auto mb-3">
                    <input required type="text" name="name" id="login_name" placeholder="NAME" class="form-control fs-5 p-3">
                </div>
                <div class="form-group m-auto mb-3">
                    <input required type="password" name="password" id="login_password" placeholder="PASSWORD" class="form-control fs-5 p-3">
                </div>
                <div class="form-group m-auto  mb-3">
                    <input required type="conf_password" name="conf_password" id="login_conf_password" placeholder="CONFIRM PASSWORD" class="form-control fs-5 p-3">
                </div>
                <div class="form-group m-auto  mb-3">
                    <input required type="submit" value="Register" class="btn btn-primary btn-lg btn-Register-color text-white">
                </div>
                
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>