<?php 
    $path = $_SERVER['PHP_SELF'];
    $str = explode("/",$path);
    switch ($str[count($str)-1]){
        case "setting.php":
            $setting = "active_section";
            break;
        case "user.php":
            $user = "active_section";
            break;
        case "rank.php":
            $rank = "active_section";
            break;
        case "educational":
            $rank = "active_section";
            break;
        case "random":
            $rank = "active_section";
            break;
        case "home.php":
            $home = "active_section";
            break;
    }
?>

<div class="appBar">
    <div class="cards-appBar">
        <a href="setting.php">
            <img class="white <?php echo $setting ?>" src="../../assets/appBar/setting.svg" alt="">
        </a>
        <a href="ranking.php?ranking_type=educational"  style="">
            <img class="white <?php echo $rank ?>"src="../../assets/appBar/ranking.svg" alt="">
        </a>
        <a href="home.php">
            <img class="white <?php echo $home ?>" src="../../assets/appBar/play.svg" alt="">
        </a>
        <a href="user.php">
            <img class="white <?php echo $user ?>" src="../../assets/appBar/user.svg" alt="">
        </a>
    </div>
</div>


<audio id="musicPlayer" autoplay loop>
    <source src="../../assets/soundEffects/SoundTrackToOurGame.mp3" type="audio/mpeg" id="volumeSlider">
</audio>

<?php
$vol = $_SESSION["vol"]/100;
echo $q = "
<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
<script>
        $(document).ready(function() {
            $('#musicPlayer')[0].volume =  $vol;
    });
</script>
"


?>