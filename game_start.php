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
    <link rel="stylesheet" href="css/all.min.css"> <!-- fontawesome -->
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/tailwind.css">
    <link rel="stylesheet" href="css/tooplate-antique-cafe.css">
    
</head>
<body>
    <div id="about" class="parallax-window" data-parallax="scroll" data-image-src="img/antique-cafe-bg-03.jpg">
        <div class="container mx-auto tm-container py-24 sm:py-48">
            <div class="tm-item-container sm:ml-auto sm:mr-12 mx-auto sm:px-0 px-4">
                <div class="bg-white bg-opacity-80 p-12 pb-14 rounded-xl mb-5">
                    <h2 class="mb-6 tm-text-green text-4xl font-medium">The Game Launcher</h2>
                    <p class="mb-6 text-base leading-8">
                        When you complete each level you got a passcode to unlock the next level.
                        Enjoy the game and have fun.
                  </p>
                    <p class="text-base leading-8">
                        If you wish to <a rel="nofollow" href="https://www.tooplate.com/contact" target="_parent">support us</a>, please make a little donation via PayPal. That would be
                    very helpful. Another way is to tell your friends about Tooplate website. Thank you. </p>
                </div>
                <a href="#contact" class="inline-block tm-bg-green transition text-white text-xl pt-3 pb-4 px-8 rounded-md">
                    <i class="far fa-comments mr-4"></i>
                    Contact
                </a>
            </div>           
        </div>        
    </div>
   
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <script src="js/jquery.singlePageNav.min.js"></script>
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