<?php
$titlePage = "Create Game";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/navBar.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/checkLogged.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";
?>
<link rel="stylesheet" href="../../css/index.css">
<link rel="stylesheet" href="../../css/home.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
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

    .info {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .change_info {
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
    }

    .custom_games {
        overflow: scroll;
        max-height: 200px;
    }

    nav {
        display: flex;
        flex-direction: row-reverse;
        justify-content: space-between;
    }

    .background_games {
        background: linear-gradient(45deg, #BB1900, #FD6F01, #FFB000);
        color: white;
    }

    textarea {
        resize: none;
    }

    hr {
        width: 100%;
    }
    .red{
        color:red;
    }
</style>
<div class="container">
    <!-- for the settings and profile if logged in -->
    <nav class="d-flex">
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
            <a href="javascript:history.back(1)" class="d-flex">
                <div class="circle-setting d-inline p-1">
                    <img src="<?php echo "../../assets/back.svg" ?>" alt="">
                </div>
            </a>
        </div>
    </nav>
    </nav>
    <!-- main -->
    <main>
        <form class="info mt-5 w-75" >
        <div class="image_of_quiz">
                <label for="imageQuiz">Upload the image <span class="red">*</span></label>
                <input class="form-control" type="file" name="imageQuiz" id="imageQuiz" accept="image/jpg , image/png ,image/jpeg , image/webp" required>
            </div>
            <div class="name_of_quiz">
                <label for="nameQuiz">name your quiz <span class="red">*</span></label>
                <input class="form-control" type="text" name="nameQuiz" id="nameQuiz" required>
            </div>
            <div class="desc mt-3">
                <label for="nameQuiz">write a short description <span class="red">*</span></label>
                <textarea class="form-control" cols="50" type="text" name="descQuiz" id="descQuiz" required></textarea>
            </div>
            <hr>
            <div id="questions">
            </div>
            <div id="addQ" type="none" class="logout_btn mt-5">Add question</div>
            <div type="submit" id="upload" value="upload your quiz" class="logout_btn change_info mt-2">upload your quiz</div>
        </form>
</div>

<script>
    let addBtn = document.getElementById("addQ");
    let section_q = document.getElementById("questions");
    let i = 0;

    addBtn.addEventListener("click", () => {
        i++;
        let q = `
        <div class="mb-3">
            <input type="text" class="form-control mb-2 question${i}" name="question${i}" id="question${i}" placeholder="Write your question number ${i}" required>
            <div class="answers d-flex">
                <input type="text" class="form-control" name="correct_answer${i}" id="correct_answer${i}" placeholder="Correct" required>
                <input type="text" class="form-control" name="wrong_answer${i}" id="wrong_answer${i}" placeholder="Wrong" required>
                <input type="text" class="form-control" name="wrong_answer2${i}" id="wrong_answer2${i}" placeholder="Wrong" required>
                <input type="text" class="form-control" name="wrong_answer3${i}" id="wrong_answer3${i}" placeholder="Wrong" required>
            </div>
        </div>
        `;
        section_q.insertAdjacentHTML('beforeend', q);
    });

    let uploadBtn = document.getElementById("upload");

    uploadBtn.addEventListener("click", () => {
        let nameQuiz = document.getElementById("nameQuiz").value;
        let descQuiz = document.getElementById("descQuiz").value;
        let imgQuiz = document.getElementById("imageQuiz");
        let file = imgQuiz.files[0];

        let formData = new FormData();
        formData.append("nameQuiz", nameQuiz);
        formData.append("descQuiz", descQuiz);
        formData.append("imageFile", file);

        let http = new XMLHttpRequest();
        let url = "http://localhost:8012/project_eng_2/pages/typeMood/sendQuiz.php";
        http.open('POST', url, true);
        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                console.log(http.responseText);
                sendQuestions(i);
            } else if (http.readyState == 4) {
                console.log("Error:", http.status, http.statusText);
            }
        };
        http.send(formData);
    });

    function sendQuestions(totalQuestions) {
        for (let j = 1; j <= totalQuestions; j++) {
            let questionInput = document.getElementById(`question${j}`).value;
            let correctAnswer = document.getElementById(`correct_answer${j}`).value;
            let wrongAnswer1 = document.getElementById(`wrong_answer${j}`).value;
            let wrongAnswer2 = document.getElementById(`wrong_answer2${j}`).value;
            let wrongAnswer3 = document.getElementById(`wrong_answer3${j}`).value;

            let formData = new FormData();
            formData.append("question", questionInput);
            formData.append("correctAnswer", correctAnswer);
            formData.append("wrongAnswer1", wrongAnswer1);
            formData.append("wrongAnswer2", wrongAnswer2);
            formData.append("wrongAnswer3", wrongAnswer3);

            let http = new XMLHttpRequest();
            let url = "http://localhost:8012/project_eng_2/pages/typeMood/sendQus.php";
            http.open('POST', url, true);
            http.onreadystatechange = function () {
                if (http.readyState == 4 && http.status == 200) {
                    console.log(http.responseText);
                } else if (http.readyState == 4) {
                    console.log("Error:", http.status, http.statusText);
                }
            };
            http.send(formData);
        }

        window.location.href = "custom_game.php";
    }
</script>