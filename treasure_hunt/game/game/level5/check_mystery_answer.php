<?php
include '../../config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$question_id = intval($_POST['question_id']);
$answer = trim(strtolower($_POST['answer']));  // Normalize input

// Fetch correct answer for the given question ID
$answer_query = $conn->query("SELECT answer FROM th_mystery_box WHERE id = $question_id LIMIT 1");

if (!$answer_query || $answer_query->num_rows == 0) {
    echo json_encode(["success" => false, "message" => "Invalid question ID"]);
    exit;
}

$correct_answer = trim(strtolower($answer_query->fetch_assoc()['answer']));  // Normalize DB answer

if ($answer === $correct_answer) {
    // Check if user already attempted
    $check_attempt = $conn->query("SELECT * FROM th_mystery_box_scores WHERE user_id = $user_id LIMIT 1");

    if ($check_attempt->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "❌ You have already attempted this challenge."]);
        exit;
    }

    // Insert score since the answer is correct
    $score = 100;
    $insert_query = $conn->query("INSERT INTO th_mystery_box_scores (user_id, question_id, attempts, solved_at, score) 
                                  VALUES ($user_id, $question_id, 1, NOW(), $score)");

    if (!$insert_query) {
        echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
        exit;
    }

    echo json_encode(["success" => true, "message" => "🎉 Correct! Moving to the Memory Game..."]);
} else {
    echo json_encode(["success" => false, "message" => "❌ Incorrect! Try again."]);
}
?>
