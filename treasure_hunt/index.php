<?php
ob_start(); // Start output buffering to prevent header issues
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($email) && !empty($password)) {
        $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["email"] = $user["email"];
                
                // Redirect to quiz page after successful login
                header("Location: game/game_start.php");
                exit();
            } else {
                $error_message = "Incorrect password!";
            }
        } else {
            $error_message = "Email not found or OTP not verified.";
        }
    } else {
        $error_message = "Please fill in all fields.";
    }
}

ob_end_flush(); // End output buffering
?>
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
    <link rel="stylesheet" href="../css/all.min.css"> <!-- fontawesome -->
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../css/tailwind.css">
    <link rel="stylesheet" href="../css/tooplate-antique-cafe.css">
    
</head>
 <!-- Intro -->
        <nav id="tm-nav" class="fixed w-full">
            <div class="tm-container mx-auto px-2 md:py-6 text-right">
                <button class="md:hidden py-2 px-2" id="menu-toggle"><i class="fas fa-2x fa-bars tm-text-gold"></i></button>
                <ul class="mb-3 md:mb-0 text-2xl font-normal flex justify-end flex-col md:flex-row">
                    <li class="inline-block mb-4 mx-4"><a href="#" class="tm-text-gold py-1 md:py-3 px-4">Login</a></li>
                    <li class="inline-block mb-4 mx-4"><a href="#rules" class="tm-text-gold py-1 md:py-3 px-4">Rules</a></li>
                    <li class="inline-block mb-4 mx-4"><a href="#prize" class="tm-text-gold py-1 md:py-3 px-4">Prizes</a></li>
                    <li class="inline-block mb-4 mx-4"><a href="#terms" class="tm-text-gold py-1 md:py-3 px-4">Terms</a></li>
                    <li class="inline-block mb-4 mx-4"><a href="#contact" class="tm-text-gold py-1 md:py-3 px-4">Contact</a></li>

                </ul>
            </div>            
        </nav>

<div id="contact" class="parallax-window relative" data-parallax="scroll" data-image-src="../img/login-bg.jpg">
        <div class="container mx-auto tm-container pt-24 pb-48 sm:py-48">
            <div class="flex flex-col lg:flex-row justify-around items-center lg:items-stretch">
                <div class="flex-1 rounded-xl px-10 py-12 m-5 bg-white bg-opacity-80 tm-item-container">
                    <h2 class="text-3xl mb-6 tm-text-green">Welcome to the Treasure Hunt!</h2>
                    <p class="mb-6 text-lg leading-8">
                    Embark on an exciting adventure filled with quizzes and puzzles. Log in to begin your journey and unlock the hidden treasures.
                     Are you ready for the challenge?  
                    </p>
                    <p class="mb-10 text-lg">
                        <span class="block mb-2">Tel: <a href="tel:0100200340" class="hover:text-yellow-600 transition">010-020-0340</a></span>
                        <span class="block">Email: <a href="mailto:game@smeclabs.net" class="hover:text-yellow-600 transition">game@smeclabs.net</a></span>                        
                    </p>
                    <div class="text-center">
                        <a href="https://www.google.com/maps" class="inline-block text-white text-2xl pl-10 pr-12 py-6 rounded-lg transition tm-bg-green">
                            <i class="fas fa-book mr-8"></i>
                            Read Terms
                        </a>
                    </div>                    
                </div>
                <div class="flex-1 rounded-xl p-12 pb-14 m-5 bg-black bg-opacity-50 tm-item-container">

                    <?php if (isset($error_message)) { ?>
                            <div class="error-message"><?= htmlspecialchars($error_message) ?></div>
                        <?php } ?>

                        <form method="POST" class="signin-form">
                        
                        <input type="email" name="email" class="input w-full bg-black border-b bg-opacity-0 text-white px-0 py-4 mb-4 tm-border-gold" name="email" placeholder="Enter your email" required />
                        <input type="password" class="input w-full bg-black border-b bg-opacity-0 text-white px-0 py-4 mb-4 tm-border-gold"  name="password" placeholder="Enter your password" required />
                        <div class="text-right">
                            <button type="submit" class="text-white hover:text-yellow-500 transition">Login</button>
                            <p class="text-center" style="color:white;!important">Not a member? <a href="register.php" style="color:#ffe134;!important">Sign Up</a></p>
                            <p class="text-center"><a href="terms.php" style="color:#ffe134;!important">Terms & Conditions Applied</a></p>
                        </div>                        
                      </form>
                </div>
            </div>

            <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/parallax.min.js"></script>
    <script src="../js/jquery.singlePageNav.min.js"></script>
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
</body>
</html>


                        
                        