<?php
session_start();
include '../../config.php';

$user_id = $_SESSION['user_id'];
$attempts = $_POST['attempts'];
$time = $_POST['time'];

$query = $conn->prepare("INSERT INTO th_memory_game (user_id, total_attempts, time_taken, status) VALUES (?, ?, ?, 1)");
$query->bind_param("iii", $user_id, $attempts, $time);
$query->execute();

echo "success";
?>
