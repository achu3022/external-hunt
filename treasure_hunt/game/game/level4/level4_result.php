<?php
session_start();
include '../../config.php';

// Securely fetch user id
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: ../../../index.php");
    exit();
}

// Fetch total score from level4_scores
$result = $conn->query("SELECT SUM(score) AS total_score FROM level4_scores WHERE user_id = $user_id");
$row = $result->fetch_assoc();
$total_score = $row['total_score'] ?? 0;

$qualified = $total_score >= 7 ? true : false;
$password = "";

if ($qualified) {
    $stmt = $conn->prepare("SELECT passcode FROM passwords WHERE level = 5 AND user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($password);
    $stmt->fetch();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level 4 Result</title>
    <style>
        body {
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            text-align: center;
            color: white;
        }
        #result-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            margin: auto;
            margin-top: 15%;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.3);
        }
        h1 {
            font-size: 28px;
        }
        .passcode {
            font-size: 22px;
            font-weight: bold;
            color: yellow;
        }
    </style>
    <script>
        function disableBackRefresh() {
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };
            window.addEventListener("beforeunload", function (event) {
                event.preventDefault();
                event.returnValue = "";
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            disableBackRefresh();
            setTimeout(() => {
                window.location.href = "../../game_start.php";
            }, 10000); // Auto-redirect after 5 seconds
        });
    </script>
</head>
<body>
    <div id="result-container">
        <?php if ($qualified): ?>
            <h1>🎉 Congratulations! 🎉</h1>
            <p>You have passed Level 4!</p>
            <p class="passcode">Your Level 5 Password: <b><?php echo htmlspecialchars($password); ?></b></p>
            <p>Redirecting to Level 5...</p>
        <?php else: ?>
            <h1>😞 Sorry! 😞</h1>
            <p>You didn't qualify for Level 5. Try again!</p>
            <p>Redirecting to start...</p>
        <?php endif; ?>
    </div>
</body>
</html>
