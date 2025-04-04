<?php
session_start();
include '../../config.php'; // Database connection

// Securely fetch user id
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: ../../../index.php");
    exit();
}

// Fetch user passcode for Level 5
$stmt = $conn->prepare("SELECT passcode FROM passwords WHERE user_id = ? AND level = 5");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($passcode);
$stmt->fetch();
$stmt->close();

if (!$passcode) {
    echo "No record found!";
    exit();
}

// Check if user has played Level 4
$stmt = $conn->prepare("SELECT SUM(score) FROM level4_scores WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($score);
$stmt->fetch();
$stmt->close();

// If the user has played Level 4
if ($score !== null) {
    if ($score >= 7) {
        echo "Congratulations! You scored $score/10. Your Level 5 passcode is: <strong>$passcode</strong>";
    } else {
        echo "Sorry, you scored $score/10. You did not qualify for Level 5.";
    }
} else {
    header("Location: level4_game.php");
}
?>
