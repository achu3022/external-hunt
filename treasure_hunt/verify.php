<?php
session_start(); // Start session to access stored email
include 'config.php';

if (!isset($_SESSION['email'])) {
    //Redirect to registration page if no email is stored in the session
   header("Location: register.php");
   exit();
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antique Bakery Cafe HTML Template by Tooplate</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600&family=Oswald:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/all.min.css"> <!-- fontawesome -->
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../css/tailwind.css">
    <link rel="stylesheet" href="../css/tooplate-antique-cafe.css">
    
</head>
<body>   


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
							<form method="POST" class="signin-form">
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $email = $_SESSION['email']; // Retrieve email from session
                                $otp = $_POST["otp"];
                            
                                // Correct query to check OTP without expiry time
                                $query = $conn->prepare("SELECT * FROM users WHERE email = ? AND otp_code = ?");
                                $query->bind_param("ss", $email, $otp);
                                $query->execute();
                                $result = $query->get_result();
                                if ($result->num_rows > 0) {
                                    // OTP Verified - Activate Account
                                   $conn->query("UPDATE users SET otp_code = NULL WHERE email = '$email'");
                                   echo '<div class="text-success" style="color:white;">OTP Verified! You can now <a href="index.php">Login</a></div>';
                                   unset($_SESSION['email']); // Clear session after successful verification
                                   } else {
                                       echo '<div class="text-danger">Invalid OTP. Try again!</div>';
                                   }
                            }
                            ?>
								
			      		<div class="form-group mb-3">
			      			<input type="text"  class="input w-full bg-black border-b bg-opacity-0 text-white px-0 py-4 mb-4 tm-border-gold" name="otp" placeholder="Enter OTP" required>
			      		</div>
		           
		            <div class="form-group">
					<button type="submit" class="text-white hover:text-yellow-500 transition">Verify OTP </button>
						            </div>
		            
		          </form>
		          <p class="text-center">Not a member? <a href="register.php">Sign Up</a></p>
                  <p class="text-center"><a href="terms.php">Terms & Conditions Applied</a></p>
		        </div>
		      </div>
				</div>
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
