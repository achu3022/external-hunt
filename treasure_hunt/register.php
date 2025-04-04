<?php
session_start();
include 'config.php';
include 'send_mail.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $qualification = $_POST["qualification"];
    $dob = $_POST["dob"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hash Password
    $referred_by = $_POST["referral_code"]; // Optional Referral Code

    // Check if email already exists
    $check_email = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($check_email->num_rows > 0) {
        die("Email already registered!");
    }

    // Generate OTP
    $otp = rand(100000, 999999);

    // Generate Unique Referral Code
    $referral_code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 8);

    // Insert user with OTP
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, address, qualification, dob, password, otp_code, referral_code, referred_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $name, $email, $phone, $address, $qualification, $dob, $password, $otp, $referral_code, $referred_by);
    $stmt->execute();
	if ($stmt->affected_rows > 0) {
		$user_id = $stmt->insert_id; // Get the last inserted user ID
	
		// Function to generate a random 6-character alphanumeric passcode
		function generatePasscode() {
			return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);
		}
	
		// Insert passcodes for levels 1 to 5
		$password_stmt = $conn->prepare("INSERT INTO passwords (user_id, level, passcode) VALUES (?, ?, ?)");
		for ($level = 1; $level <= 5; $level++) {
			$passcode = generatePasscode();
			$password_stmt->bind_param("iis", $user_id, $level, $passcode);
			$password_stmt->execute();
		}
		$password_stmt->close();
	}
	

    // Send OTP Email
    $subject = "Your OTP Code for Quiz Registration";
    $body = "Your OTP is: <b>$otp</b>";
    sendMail($email, $subject, $body);

    $_SESSION['email'] = $email; // Store email for verification step
    header("Location: verify.php");
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
						<input type="text"  class="input w-full bg-black border-b bg-opacity-0 text-white px-0 py-4 mb-4 tm-border-gold" name="name" placeholder="Full Name" require />
                        <input type="email" class="input w-full bg-black border-b bg-opacity-0 text-white px-0 py-4 mb-4 tm-border-gold" name="email" placeholder="Email Id" required />
						<input type="text" class="input w-full bg-black border-b bg-opacity-0 text-white px-0 py-4 mb-4 tm-border-gold" name="phone" placeholder="Phone Number" required />
                        <input type="text" class="input w-full bg-black border-b bg-opacity-0 text-white px-0 py-4 mb-4 tm-border-gold" name="address" placeholder="Place" required/>
                        <input type="text" class="input w-full bg-black border-b bg-opacity-0 text-white px-0 py-4 mb-4 tm-border-gold" name="qualification" placeholder="Qualification" required />
                        <input type="date" class="input w-full bg-black border-b bg-opacity-0 text-white px-0 py-4 mb-4 tm-border-gold" name="dob"  required />
                        <input type="password" class="input w-full bg-black border-b bg-opacity-0 text-white px-0 py-4 mb-4 tm-border-gold" name="password" placeholder="Password"  required />



                        <div class="text-right">
							
                            <button type="submit" class="text-white hover:text-yellow-500 transition">Register </button>

							<p class="text-center" style="color:white;">Already Register? <a href="index.php" style="color:#F7FCFD;";>Sign In</a></p>
                  <p class="text-center"><a href="terms.php" style="color:#E2E5DE;">Terms & Conditions Applied</a></p>
                        </div>                        
                      </form>
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
