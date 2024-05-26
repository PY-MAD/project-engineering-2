<script>
    let lifeTop = document.querySelector(".chance");
let life = localStorage.getItem("life");
console.log(life);
let arrLife = [
    "<img src='../../assets/chanceGame/lifeChance.svg' width='40px' alt=''>",
    "<img src='../../assets/chanceGame/lifeChance.svg' width='40px' alt=''>",
    "<img src='../../assets/chanceGame/lifeChance.svg' width='40px' alt=''>"
]
for (let i = 0; i < life; i++) {
    lifeTop.innerHTML += arrLife[i];
    if (life == 1) {
        document.querySelector(".chance").classList.add("chance_animation");
    }
}

let checked = document.querySelectorAll(".answer_label");
checked.forEach((item) => {
    item.addEventListener("click", () => {
        if (!item.classList.contains("answer_choose")) {
            item.classList.add("answer_choose");
            item.id = "choose_answer";
            item.classList.remove("answer");
            checked.forEach((item2) => {
                if (item2 != item) {
                    item2.classList.remove("answer_choose");
                    item.classList.add("answer");
                    item2.id = "";
                }
            });
        }
    });
});

let submit = document.getElementById("submitBtn");
submit.addEventListener("click", (event) => {
    event.preventDefault(); // Prevent form from submitting immediately
    let answer = document.getElementById("choose_answer");
    let score_num = document.querySelector(".score_num");
    console.log(answer.getAttribute("data-answer"));
    console.log(correct_answer);

    if (answer.getAttribute("data-answer") == correct_answer) {
        answer.classList.add("green");
        let currentScore = parseInt(score_num.textContent);
        let newScore = currentScore + 10;
        animateScoreIncrement(currentScore, newScore, score_num, () => {
            score_num.innerHTML = newScore;
        });
        correctAnswer();
    } else {
        answer.classList.add("red");
        WrongAnswer();
        let life = parseInt(localStorage.getItem("life")) - 1;
        localStorage.setItem("life", life);
        if (life <= 0) {
            // Handle game over scenario
            alert("Game over!");
            // Redirect or reset game logic
        }
    }
    answer.classList.remove("answer_choose");
    answer.classList.remove("answer");

    // Submit form after processing
    document.getElementById("quiz-form").submit();
});

function correctAnswer() {
    document.getElementById("correctAnswerEffect").play();
}

function WrongAnswer() {
    document.getElementById("WrongAnswerEffect").play();
}

// Function to animate score increment
function animateScoreIncrement(start, end, score_num, callback) {
    let score = start;
    let increment = 1; // Change this value to adjust the increment speed
    let animationInterval = setInterval(function () {
        score += increment;
        score_num.innerHTML = score;
        if (score >= end) {
            clearInterval(animationInterval);
            callback(); // Call the callback function once the animation is complete
        }
    }, 50); // Change this value to adjust the animation speed (milliseconds per frame)
}
</script>