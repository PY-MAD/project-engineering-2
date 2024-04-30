<?php 
$titlePage = "welcome our friend !";
include_once "template/navBar.php";

?>
<link rel="stylesheet" href="css/index.css">
    <div class="container">
        <!-- for the settings and profile if logged in -->
        <a href="">
            <nav>
                <div class="circle-setting">
                    <img src="<?php echo "assets/setting/setting.svg"?>" alt="">
                </div>
            </nav>
        </a>
        <!-- for main content -->
        <main>
            <div class="card mb-4">
                <div class="text">
                    <div>Welcome our new friend !</div>
                    <img src="assets/hume_main/say hi.svg" width="400px" alt="">
                </div>
            </div>
            <div class="card mb-4">
                <div class="text">
                    <div style="font-size: 28px;" >You learn the language what you love !</div>
                    <img src="assets/hume_main/learning.svg" width="400px" alt="">
                </div>
            </div>
            <div class="card mb-4">
                <div class="text">
                    <div>Sign up to fun with learn !</div>
                </div>
            </div>
            <div class="link_toSignUp">
                <a href="pages/register.php" class="mb-4 mt-4">
                        <button class="btn btn-primary sign_up">SIGN UP !</button>
                </a>
            </div>
        </main>


    </div>
<?php include_once "template/footer.php" ?>