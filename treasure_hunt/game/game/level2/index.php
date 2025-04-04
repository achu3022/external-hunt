<?php
session_start();
include '../../config.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if user has already played Level 3
$check_attempt_query = "SELECT MAX(score) AS last_score FROM level3_scores WHERE user_id = ?";
$check_stmt = $conn->prepare($check_attempt_query);
$check_stmt->bind_param("i", $user_id);
$check_stmt->execute();
$attempt_result = $check_stmt->get_result();
$attempt_data = $attempt_result->fetch_assoc();
$previous_score = $attempt_data['last_score'] ?? 0;

// Fetch password for next level (Level 4)
$password_query = "SELECT passcode FROM passwords WHERE level = 3 AND user_id = ?";
$password_stmt = $conn->prepare($password_query);
$password_stmt->bind_param("i", $user_id);
$password_stmt->execute();
$password_result = $password_stmt->get_result();
$password_data = $password_result->fetch_assoc();
$passcode = $password_data['passcode'] ?? null;
$_SESSION['passcode'] = $passcode;

// If user has already attempted the quiz, display the result
if ($previous_score > 0) {
    echo "<div class='container text-center mt-5'>";
    echo "<h3 class='text-danger'>You have already attempted the quiz!</h3>";
    echo "<p>Your last quiz score: <strong>$previous_score / 10</strong></p>";

    if ($previous_score >= 8) {
        echo "<p class='text-success'>Congratulations! You passed!</p>";
        echo "<p>Your passcode for the next level: <strong>$passcode</strong></p>";
    } else {
        echo "<p class='text-warning'>Sorry, you didn't pass. Try again!</p>";
    }

    echo "<a href='../../game_start.php' class='btn btn-primary mt-3'>Go to Dashboard</a>";
    echo "</div>";
    exit();
}

// Fetch 10 random questions
$query = "SELECT * FROM level3_questions ORDER BY RAND() LIMIT 10";
$result = $conn->query($query);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

// Store questions in session
$_SESSION['level3_questions'] = $questions;

// Set quiz duration (15 minutes) and prevent reset on refresh
if (!isset($_SESSION['quiz_start_time'])) {
    $_SESSION['quiz_start_time'] = time();
}

$quiz_duration = 900; // 15 minutes in seconds
$end_time = $_SESSION['quiz_start_time'] + $quiz_duration;
$remaining_time = max($end_time - time(), 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level 3 Quiz</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            background-image: url('quiz-bg.jpg'); /* Set your background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }
        .quiz-container {
            max-width: 800px;
            margin: auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .question {
            margin-bottom: 20px;
        }
        .timer {
            font-size: 20px;
            color: red;
            font-weight: bold;
            text-align: right;
        }
        .btn-custom {
            width: 100%;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container quiz-container">
        <h2 class="text-center text-primary">SMEC Trivia Challenge</h2>
        <p class="timer">Time Left: <span id="timer"><?= floor($remaining_time / 60) . "m " . ($remaining_time % 60) . "s"; ?></span></p>

        <form id="quizForm" action="level3_submit.php" method="post">
            <?php foreach ($questions as $index => $q) { ?>
                <div class="question">
                    <p><strong><?php echo ($index + 1) . ". " . htmlspecialchars($q['question']); ?></strong></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[<?php echo $q['id']; ?>]" value="A" required>
                        <label class="form-check-label"><?php echo htmlspecialchars($q['option_a']); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[<?php echo $q['id']; ?>]" value="B">
                        <label class="form-check-label"><?php echo htmlspecialchars($q['option_b']); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[<?php echo $q['id']; ?>]" value="C">
                        <label class="form-check-label"><?php echo htmlspecialchars($q['option_c']); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[<?php echo $q['id']; ?>]" value="D">
                        <label class="form-check-label"><?php echo htmlspecialchars($q['option_d']); ?></label>
                    </div>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-success mt-3 btn-custom">Submit Answers</button>
        </form>
    </div>

    <script>
        let timeLeft = <?= $remaining_time; ?>;
        function countdown() {
            if (timeLeft <= 0) {
                document.getElementById("quizForm").submit();
            } else {
                let minutes = Math.floor(timeLeft / 60);
                let seconds = timeLeft % 60;
                document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s";
                timeLeft--;
                setTimeout(countdown, 1000);
            }
        }
        window.onload = countdown;
    </script>
</body>
</html>
