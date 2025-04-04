<?php
include '../../config.php';
session_start();

$user_id = $_SESSION['user_id'];
$attempts = $_POST['attempts'];
$success = $_POST['success'];

if ($success) {
    // Get the latest winner position
    $result = $conn->query("SELECT MAX(winner_position) AS last_position FROM th_memory_game WHERE status = 1");
    $row = $result->fetch_assoc();
    $winner_position = ($row['last_position'] !== null) ? $row['last_position'] + 1 : 1; // Assign next position

    // Insert the memory game result with winner position
    $conn->query("INSERT INTO th_memory_game (user_id, total_attempts, time_taken, status, completed_at, winner_position) 
                 VALUES ($user_id, $attempts, 90 - $attempts, 1, NOW(), $winner_position)");
} else {
    // If time is up, store result with position 0
    $conn->query("INSERT INTO th_memory_game (user_id, total_attempts, time_taken, status, completed_at, winner_position) 
                 VALUES ($user_id, $attempts, 0, 0, NOW(), 0)");
}

echo json_encode(["success" => $success]);
?>
