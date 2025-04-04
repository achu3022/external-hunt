<?php
include '../../config.php';
session_start();

$user_id = $_SESSION['user_id'];

// Fetch the user's winner position
$result = $conn->query("SELECT winner_position FROM th_memory_game WHERE user_id = $user_id AND status = 1");
$user_data = $result->fetch_assoc();

if ($user_data && $user_data['winner_position']) {
    $winner_position = $user_data['winner_position'];

    // Get the prize for this winner position
    $prize = $conn->query("SELECT * FROM th_prizes WHERE winner_position = $winner_position")->fetch_assoc();

    if ($prize && $winner_position >= 1 && $winner_position <= 5) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>🏆 Congratulations!</title>
            <style>
               body {
    font-family: 'Arial', sans-serif;
    background: url('prize.webp') no-repeat center center;
    background-size: cover;
    color: white;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
    position: relative;
}

body {
    font-family: 'Arial', sans-serif;
    background: url('prize.webp') no-repeat center center;
    background-size: cover;
    color: white;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
    position: relative;
}

body::aftere {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Black overlay with 60% transparency */
    z-index: 0; /* Behind the content */
}

                .win-box {
                    background: rgba(0, 0, 0, 0.7); /* Black Glass Effect */
                    padding: 30px;
                    border-radius: 15px;
                    box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.7);
                    max-width: 400px;
                    text-align: center;
                    animation: fadeIn 1s ease-in-out;
                }

                h2 {
                    color:rgb(255, 255, 255);
                    font-size: 28px;
                    animation: glow 1s infinite alternate;
                }

                h3 {
                    font-size: 24px;
                    color: #ffffff;
                    font-weight: bold;
                }

                .prize {
                    font-size: 26px;
                    color:rgb(255, 0, 0);
                    font-weight: bold;
                    text-shadow: 0 0 10px rgba(255, 221, 87, 0.8);
                }

                .amount {
                    font-size: 22px;
                    color: #00ffcc;
                    font-weight: bold;
                }

                .chest {
                    width: 120px;
                    height: 120px;
                    background: url('chest_closed.png') no-repeat center;
                    background-size: contain;
                    margin: 20px auto;
                    transition: transform 0.5s ease-in-out;
                }

                .chest.open {
                    background: url('chest_open.png') no-repeat center;
                    background-size: contain;
                    transform: scale(1.1);
                }

                @keyframes glow {
                    from { text-shadow: 0 0 5px #ffcc00; }
                    to { text-shadow: 0 0 15px #ffcc00, 0 0 20px #ff9900; }
                }

                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(-10px); }
                    to { opacity: 1; transform: translateY(0); }
                }
            </style>
        </head>
        <body>
            <div class="win-box">
                <h2>🎉 Congratulations! 🎉</h2>
                <h3>🏆 You secured <span class="prize"><?= htmlspecialchars($prize['winner_position']) ?> position!</span></h3>
                <h3>🎁 Your Prize: <span class="prize"><?= htmlspecialchars($prize['prize_name']) ?></span></h3>
                <h3>💰 Prize Amount: <span class="amount">₹<?= htmlspecialchars($prize['prize_amount']) ?> /-</span></h3>
                <div class="chest" id="chest"></div>

                <h3>🎉 Claim your prize from the event organizer! 🎉</h3>
                <h3>🎉 Thank you for participating! 🎉</h3>
                <a href="../../logout.php" style="color: #ffcc00; text-decoration: none;">Logout</a>
                
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    setTimeout(() => {
                        document.getElementById("chest").classList.add("open");
                    }, 1500);
                });


                document.addEventListener("DOMContentLoaded", function() {
        setTimeout(() => {
            document.getElementById("chest").classList.add("open");
        }, 1500);

        // Redirect to game_start.php after 15 seconds
        setTimeout(() => {
            window.location.href = "../../../game/game_start.php";
        }, 15000);
    });


            </script>
        </body>
        </html>
        <?php
    } else {
        echo "<h2>Sorry, no prize available for your position.</h2>";
    }
} else {
    echo "<h2>Sorry, you have not won the game yet.</h2>";
}
?>
