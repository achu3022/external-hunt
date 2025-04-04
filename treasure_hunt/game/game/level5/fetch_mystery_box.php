<?php
include '../../config.php';
session_start();

// Fetch a random question
$result = $conn->query("SELECT id, question, hint FROM th_mystery_box ORDER BY RAND() LIMIT 1");

if ($result->num_rows > 0) {
    $question = $result->fetch_assoc();
    echo json_encode($question);
} else {
    echo json_encode(["error" => "No questions found"]);
}
?>
