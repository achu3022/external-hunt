<?php
session_start();
include '../../config.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user name from database
$query = $conn->prepare("SELECT name FROM users WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
$user_name = $user['name'] ?? 'User';

// Check if quiz is completed
if ($_SESSION['current_question'] >= count($_SESSION['questions'])) {
    header("Location: result.php");
    exit();
}

// Fetch current question (DO NOT increment yet)
$question_number = $_SESSION['current_question'] + 1;
$question = $_SESSION['questions'][$_SESSION['current_question']];

?>
<style>
    body{
        background-image: url('home-bg.webp');
  background-size: cover; /* This will ensure the image covers the entire element */
  background-position: center; /* This will center the image */
  background-repeat: no-repeat; /* This prevents the image from repeating */
}

label.radio {
  cursor: pointer;
}

label.radio input {
  position: absolute;
  top: 0; 
  left: 0;
  visibility: hidden;
  pointer-events: none;
}

label.radio span {
  padding: 4px 0px;
  border: 1px solid red;
  display: inline-block;
  color: red;
  width: 200px;
  text-align: center;
  border-radius: 3px;
  margin-top: 7px;
  text-transform: uppercase;
}

label.radio input:checked + span {
  border-color: green;
  background-color: green;
  color: #fff;
}

.ans {
  margin-left: 36px !important;
}

.btn:focus {
  outline: 0 !important;
  box-shadow: none !important;
}

.btn:active {
  outline: 0 !important;
  box-shadow: none !important;
}
.container{
    padding-top: 50px;
}
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10 col-lg-10">
                <div class="border">
                    <div class="question bg-white p-3 border-bottom">
                        <div class="d-flex flex-row justify-content-between align-items-center mcq">
                        <h4 class="text-lights" style="color :rgb(107, 37, 5);">Welcome, <?= htmlspecialchars($user_name) ?>! Get Ready for Your Quiz</h4><span>Question <?= $question_number ?> / <?= count($_SESSION['questions']) ?></span></div>
                        <div class="timer" id="timer">20</div>
                    </div>
                    <div class="question bg-white p-3 border-bottom">
                        <div class="d-flex flex-row align-items-center question-title">
                        <form method="post" action="next_question.php">
                            <h3 class="text-danger">Q.</h3>
                            <h5 class="mt-1 ml-2"><?= htmlspecialchars($question['question']) ?></h5>
                        </div><div class="ans ml-2">
<label class="radio"> <input type="radio" name="answer" value="A" required> 
<span><?= htmlspecialchars($question['option_a']) ?></span>
</label>    
</div><div class="ans ml-2">
<label class="radio"> <input type="radio" name="answer" value="B" required> 
<span><?= htmlspecialchars($question['option_b']) ?></span>
</label>    
</div><div class="ans ml-2">
<label class="radio"> <input type="radio" name="answer" value="C" required> 
<span><?= htmlspecialchars($question['option_c']) ?></span>
</label>    
</div><div class="ans ml-2">
<label class="radio"> <input type="radio" name="answer" value="D" required>
<span><?= htmlspecialchars($question['option_d']) ?></span>
</label>    
</div></div>
                    <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
                    <button type="submit" class="btn btn-success mt-3">Next</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script>
    let totalTime = 20; // Total countdown time
let timerElement = document.getElementById("timer");

// Reset timer when the page loads (new question)
sessionStorage.setItem("quiz_start_time", Date.now());

function getRemainingTime() {
    let startTime = sessionStorage.getItem("quiz_start_time");

    if (startTime) {
        let elapsedTime = Math.floor((Date.now() - startTime) / 1000);
        return Math.max(totalTime - elapsedTime, 0);
    } else {
        sessionStorage.setItem("quiz_start_time", Date.now()); // Reset on new question
        return totalTime;
    }
}

let timeLeft = getRemainingTime();

function updateTimer() {
    if (timeLeft > 0) {
        timeLeft--;
        timerElement.textContent = timeLeft;
    } else {
        sessionStorage.removeItem("quiz_start_time"); // Remove session storage when time is up
        document.forms[0].submit(); // Auto-submit if time runs out
    }
}

timerElement.textContent = timeLeft; // Set initial time
let timerInterval = setInterval(updateTimer, 1000);

// Reset timer when the form is submitted
document.forms[0].addEventListener("submit", function () {
    sessionStorage.removeItem("quiz_start_time"); // Clear old time
});

</script>

</body>
</html>
