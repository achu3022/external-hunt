<?php
session_start();
include_once '../config.php';

$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header("Location: ../index.php");
    exit();
}

// Ensure Level 1 is unlocked by default
$conn->query("INSERT IGNORE INTO user_levels (user_id, level, status) VALUES ($user_id, 1, 'unlocked')");

// Fetch user's level statuses
$levels = [];
$result = $conn->query("SELECT level, status FROM user_levels WHERE user_id = $user_id");
while ($row = $result->fetch_assoc()) {
    $levels[$row['level']] = $row['status'];
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['level'], $_POST['password'])) {
    $level = intval($_POST['level']);
    $password = $_POST['password'];

    // Fetch the correct password for the specific user and level
    $stmt = $conn->prepare("SELECT passcode FROM passwords WHERE level = ? AND user_id = ?");
    $stmt->bind_param("ii", $level, $user_id);  // Bind both level and user_id
    $stmt->execute();
    $stmt->bind_result($correct_password);
    $stmt->fetch();
    $stmt->close();

    if (!empty($correct_password) && $password === $correct_password) {
        // Mark level as completed
        $conn->query("UPDATE user_levels SET status='completed' WHERE user_id=$user_id AND level=$level");

        // Lock all other levels & unlock only the next level
        $conn->query("UPDATE user_levels SET status='locked' WHERE user_id=$user_id AND level <> $level + 1");
        $conn->query("INSERT INTO user_levels (user_id, level, status) VALUES ($user_id, $level + 1, 'unlocked') 
                      ON DUPLICATE KEY UPDATE status='unlocked'");

        echo json_encode(["status" => "success", "redirect" => "game/level$level/index.php"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Incorrect password"]);
    }
    exit();
}
?>


  
    
</head>
<body>

   
       

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kani Konna Quest  | SMECLabs Game Zone </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600&family=Oswald:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/all.min.css"> <!-- fontawesome -->
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../../css/tailwind.css">
    <link rel="stylesheet" href="../../css/tooplate-antique-cafe.css">

    <!--button styles -->

    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('https://source.unsplash.com/1600x900/?treasure,map') no-repeat center center/cover;
            text-align: center;
            color: white;
            margin: 0;
            padding: 0;
        }
        .game-container {
            max-width: 600px;
            margin: 50px auto;
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(255, 215, 0, 0.6);
        }
        h1 {
            color: #FFD700;
            text-shadow: 2px 2px 10px black;
        }
        .level-btn {
            width: 80%;
            padding: 15px;
            margin: 10px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            transition: 0.3s;
            display: block;
            text-decoration: none;
            color: white;
        }
        .unlocked {
            background:rgb(255, 177, 33);
            cursor: pointer;
        }
        .unlocked:hover {
            background:rgb(255, 159, 33);
            box-shadow: 0px 0px 10px rgba(255, 159, 33, 0.9);
        }
        .locked {
            background: gray;
            cursor: not-allowed;
        }
        .completed {
            background: darkgray;
            cursor: pointer;
        }
        .disabled {
            background: red;
            cursor: not-allowed;
        }
    </style>
    
</head>
<body>
    <div id="about" class="parallax-window" data-parallax="scroll" data-image-src="../../img/game_start.jpg">
        <div class="container mx-auto tm-container py-24 sm:py-48">
            <div class="tm-item-container sm:ml-auto sm:mr-12 mx-auto sm:px-0 px-4">
                <div class="bg-white bg-opacity-80 p-12 pb-14 rounded-xl mb-5">
                    <h2 class="mb-6 tm-text-green text-4xl font-medium">The Game Launcher</h2>
                    <p class="mb-6 text-base leading-8" style="color: black;">
                        When you complete each level you got a passcode to unlock the next level.
                        Enjoy the game and have fun.
                  </p>
                    <p class="text-base leading-8">
                    <?php
        $levelNames = [
            1 => "Brain Teaser Quest",
            2 => "SMEC Trivia Challenge",
            3 => "Puzzle Pandemonium",
            4 => "Guess Who?",
            5 => "The Final Clue"
        ];
        
        for ($level = 1; $level <= 5; $level++) {
            $status = $levels[$level] ?? "locked";
            $btnClass = ($status === "locked") ? "locked" : (($status === "completed") ? "completed" : "unlocked");
            $disabled = ($status !== "unlocked") ? "disabled" : "";
            $levelName = $levelNames[$level];
        
            echo "<button class='level-btn $btnClass' data-level='$level' onclick='unlockLevel($level, \"$status\")' $disabled>$levelName</button>";
           
        }
        ?>
                <a href="../logout.php" style="color:rgb(255, 0, 0); text-decoration: none; font-size: 18px;">Logout</a>

    </div>

            </div>           
        </div>        
    </div>
   
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/parallax.min.js"></script>
    <script src="../../js/jquery.singlePageNav.min.js"></script>
    <script>

        function checkAndShowHideMenu() {
            if(window.innerWidth < 768) {
                $('#tm-nav ul').addClass('hidden');                
            } else {
                $('#tm-nav ul').removeClass('hidden');
            }
        }

        $(function(){
            var tmNav = $('#tm-nav');
            tmNav.singlePageNav();

            checkAndShowHideMenu();
            window.addEventListener('resize', checkAndShowHideMenu);

            $('#menu-toggle').click(function(){
                $('#tm-nav ul').toggleClass('hidden');
            });

            $('#tm-nav ul li').click(function(){
                if(window.innerWidth < 768) {
                    $('#tm-nav ul').addClass('hidden');
                }                
            });

            $(document).scroll(function() {
                var distanceFromTop = $(document).scrollTop();

                if(distanceFromTop > 100) {
                    tmNav.addClass('scroll');
                } else {
                    tmNav.removeClass('scroll');
                }
            });
            
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();

                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
    <script>
        function unlockLevel(level, status) {
    if (status === "locked") {
        alert("You must complete the previous level first!");
        return;
    }
    
    if (level === 1 || status === "completed") {
        // Level 1 should open directly without password
        window.location.href = "game/level" + level + "/index.php";
        return;
    }

    let password = prompt("Enter the password for " + document.querySelector(".level-btn[data-level='" + level + "']").textContent + ":");
    if (password !== null) {
        fetch("game_start.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "level=" + level + "&password=" + encodeURIComponent(password)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                window.location.href = data.redirect;
            } else {
                alert(data.message);
            }
        });
    }
}
    </script>
</body>
</html>