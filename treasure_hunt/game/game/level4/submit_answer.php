<?php
session_start();
include '../../config.php';

$user_id = $_SESSION['user_id'];
$question_id = $_POST['question_id'];
$answer = $_POST['answer'];

// Get correct answer
$stmt = $conn->prepare("SELECT correct_answer FROM level4_identification WHERE id = ?");
$stmt->bind_param("i", $question_id);
$stmt->execute();
$stmt->bind_result($correct_answer);
$stmt->fetch();
$stmt->close();

$score = ($answer === $correct_answer) ? 1 : 0;

// Store the answer
$stmt = $conn->prepare("INSERT INTO level4_scores (user_id, question_id, selected_answer, score) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iisi", $user_id, $question_id, $answer, $score);
$stmt->execute();
$stmt->close();
?>
