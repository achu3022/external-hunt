<!--- Created by Mitchell Boland from spangle web design spangle.com.au -->
<!--- Send me a message there if you require a website, or would like some css help -->

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <title>Spangle Web Design</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600&family=Oswald:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css"> <!-- fontawesome -->
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/tailwind.css">
    <link rel="stylesheet" href="css/tooplate-antique-cafe.css">

    <style>
        html,
body {
  margin: 0;
  padding: 0;
  font-family: 'Maven Pro', sans-serif;
}

/* remove the focus from all input fields.*/

.termsAndConditions{
    z-index: 0 !important;
  margin-top: 100px;
  border-radius: 3px;
  position: absolute;
  top: 50%;
  left: 50%;
  height: 100%;
  width: 100%;
  background-color:rgb(255,255,255);
  transform: translate(-50%, -50%);
  max-width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  transform: all .2s;
  backface-visibility: hidden;
}
.termsAndConditionsHeading{
  margin-top: 70px;
  margin-bottom: 30px;
  font-size: 32px;
}
.termsParagraphIntro{
  margin-left: 15px;
  margin-right: 15px;
  margin-top: 15px;
  margin-bottom: 15px;
}
.spangleWelcome{
  font-weight: 500;
}
.serviceLeadingSection{
  width: 80%;
  margin-top: 15px;
  margin-bottom:15px;
}
.sn{
  font-size: 32px;
  padding-right: 5px;
}
.st{
  font-size: 32px;
}
.spl{
  margin-top: 15px;
  margin-bottom: 15px;

}
.serviceInfoContainer{
  position:relative;
  width: 100%;    
}
.serviceLead{
  font-weight: 700;
  margin-left: 15px;  
  margin-top: 15px;
  margin-block-end: 5px;  

}
.serviceDetails{
  margin-left: 15px;
}

.displayNone{
  display:none;
}
.secionLine{
  height: 40px;
  width:5px;

  position:absolute;
  top:7px;
}
/*Font Colours below*/
.lightGreen{
  color: rgb(85, 189, 134);
}
.blue{
  color: #2998ff;
}
.orange{
  color: #ff7730;
}
.purple{
  color: #2a0073
}

/*Set the colours for the lines*/

.lineColorGreen{
  background-image: linear-gradient(to right bottom, rgb(85, 189, 134), rgb(11, 103, 92));
}
.lineColorBlue{
  background-image: linear-gradient(to right bottom, #2998ff, #5643fa);
}
.lineColorOrange{
  background-image: linear-gradient(to right bottom, #ffb900, #ff7730);
}
.lineColorPurple{
  background-image: linear-gradient(to bottom right, #b25f88, #2a0073)
}
.closeTerms{
  border-bottom: 1px solid black;
  margin-top: 15px;
  margin-bottom: 15px;
  padding-bottom: 5px;
}
.fadeIn{
  animation-name: fadeIn;
  animation-duration: .8s;
  animation-timing-function: ease-out;
  z-index: 1001;
}

@keyframes fadeIn{
  0% {

    opacity: 0;
  }
  100%{

    opacity: 1;
  }
}
        </style>

  </head>
  <body>
     <!-- Intro -->
        <nav id="tm-nav" class="fixed w-full">
            <div class="tm-container mx-auto px-2 md:py-6 text-right">
                <button class="md:hidden py-2 px-2" id="menu-toggle"><i class="fas fa-2x fa-bars tm-text-gold"></i></button>
                <ul class="mb-3 md:mb-0 text-2xl font-normal flex justify-end flex-col md:flex-row">
                    <li class="inline-block mb-4 mx-4"><a href="treasure_hunt/index.php" class="tm-text-gold py-1 md:py-3 px-4">Login</a></li>
                    <li class="inline-block mb-4 mx-4"><a href="treasure_hunt/index.php" class="tm-text-gold py-1 md:py-3 px-4">Register</a></li>
                    <li class="inline-block mb-4 mx-4"><a href="#about" class="tm-text-gold py-1 md:py-3 px-4">Prizes</a></li>
                    <li class="inline-block mb-4 mx-4"><a href="#terms" class="tm-text-gold py-1 md:py-3 px-4">Terms</a></li>
                    <li class="inline-block mb-4 mx-4"><a href="#contact" class="tm-text-gold py-1 md:py-3 px-4">Contact</a></li>

                </ul>
            </div>            
        </nav>
    <div class="termsAndConditions fadeIn">
      <h1 class="termsAndConditionsHeading">Terms Of Service</h1>
      <h4 class="spangleWelcome">🏆 Treasure Hunt Game – Rules & Levels 🏆</h4>
      <p class="termsParagraphIntro">Welcome to the Treasure Hunt Challenge! By participating in this game, you agree to the following terms and conditions.
      </p>    
      <div class="serviceLeadingSection">
        <h4><span class="sn blue">1.</span><span class="st blue">Rules & Regulations</span></h4>
        <p class="spl">Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
          Explicabo expedita minima architecto adipisci atque neque libero 
          facilis officia blanditiis provident 
          repudiandae numquam earum dolorem hic quis ipsa, a quisquam placeat:</p>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead"><strong>Eligibility:</strong> Only registered users can participate.</h6>
          <p class="serviceDetails">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Dolores reiciendis eaque itaque facere quidem tenetur impedit nobis eum. Consequatur dignissimos aliquam 
            accusamus magnam aliquid laboriosam, neque incidunt quia voluptatem ducimus?</p>
          <div class="secionLine lineColorBlue"></div>
        </div>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead"><strong>Fair Play:</strong> No external assistance (internet, books, or help from others).</h6>
          <p class="serviceDetails">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Suscipit ducimus praesentium deserunt vitae molestiae, id illum! Atque nostrum omnis, 
            debitis eius numquam quam expedita reprehenderit delectus illo blanditiis maxime quaerat.</p>
          <div class="secionLine lineColorBlue"></div>
        </div>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead"><strong>Time Limits:</strong> Each level has a specific time constraint.</h6>
          <p class="serviceDetails">Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
            Voluptate non est delectus ex ea in voluptatum officiis? 
            Consequatur similique praesentium veniam voluptates sit sed qui id, porro facere numquam sequi?</p>
          <div class="secionLine lineColorBlue"></div>
        </div>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead"><strong>Scoring:</strong> Players must meet level criteria to advance.</h6>
          <p class="serviceDetails">Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
            Voluptate non est delectus ex ea in voluptatum officiis? 
            Consequatur similique praesentium veniam voluptates sit sed qui id, porro facere numquam sequi?</p>
          <div class="secionLine lineColorBlue"></div>
        </div>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead"><strong>Attempts:</strong> Limited attempts per level. Failing may require restarting.</h6>
          <p class="serviceDetails">Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
            Voluptate non est delectus ex ea in voluptatum officiis? 
            Consequatur similique praesentium veniam voluptates sit sed qui id, porro facere numquam sequi?</p>
          <div class="secionLine lineColorBlue"></div>
        </div>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead"><strong>Winning Criteria:</strong> Top 5 winners receive special prizes.</h6>
          <p class="serviceDetails">Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
            Voluptate non est delectus ex ea in voluptatum officiis? 
            Consequatur similique praesentium veniam voluptates sit sed qui id, porro facere numquam sequi?</p>
          <div class="secionLine lineColorBlue"></div>
        </div>    
        <div class="serviceInfoContainer">
          <h6 class="serviceLead"><strong>Automatic Redirection:</strong> After completing a level, players are redirected.</h6>
          <p class="serviceDetails">Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
            Voluptate non est delectus ex ea in voluptatum officiis? 
            Consequatur similique praesentium veniam voluptates sit sed qui id, porro facere numquam sequi?</p>
          <div class="secionLine lineColorBlue"></div>
        </div>   
        
      </div>
      

      <div class="serviceLeadingSection">
        <h4><span class="sn orange">2.</span><span class="st orange">Game Levels Breakdown</span></h4>
        <p class="spl">The game consists of five levels, each requiring players to solve different challenges. Completing a level provides a password to unlock the next stage. Level 1 is unlocked by default.</p>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead"> Level 1: Brain Teaser Quest | Quiz Challenge </h6>
          <p class="serviceDetails"><br>📌 <strong>Objective:</strong> Answer 10 general knowledge questions.<br>
            ⏳ <strong>Time Limit:</strong> 10 minutes<br>
            🎯 <strong>Requirement:</strong> Answer at least <span class="highlight">8/10</span> correctly.<br>
            🔑 <strong>Reward:</strong> A <span class="highlight">4-digit alphanumeric key</span> to unlock Level 2.</p></p>
          <div class="secionLine lineColorOrange"></div>
        </div>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead">Level 2: SMEC Trivia Challenge | Funny Quiz (SMEClabs Challenge)</h6>
          <p class="serviceDetails"><br>📌 <strong>Objective:</strong> Answer <span class="highlight">10</span> tricky and fun questions from SMEClabs.<br>
            ⏳ <strong>Time Limit:</strong> 15 minutes<br>
            🎯 <strong>Requirement:</strong> Answer <span class="highlight">all 10 correctly</span> to proceed.<br>
            🔑 <strong>Reward:</strong> A <span class="highlight">password</span> for Level 4.<br>
            🚀 <strong>Hint:</strong> Candidates <span class="highlight">can refer to SMEClabs website</span> for answers.</p>
          <div class="secionLine lineColorOrange"></div>
        </div>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead">Level 3: Puzzle Pandemonium | Puzzle Challenge </h6>
          <p class="serviceDetails"><br>📌 <strong>Objective:</strong> Solve a challenging puzzle.<br>
            ⏳ <strong>Time Limit:</strong> 10 minutes<br>
            🎯 <strong>Requirement:</strong> Complete the puzzle to proceed.<br>
            🔑 <strong>Reward:</strong> A <span class="highlight">unique key</span> to unlock Level 3.</p>
          <div class="secionLine lineColorOrange"></div>
        </div>      
        
        <div class="serviceInfoContainer">
          <h6 class="serviceLead">Level 4: Guess Who? | Identification Round </h6>
          <p class="serviceDetails"><br>📌 <strong>Objective:</strong> Identify <span class="highlight">10 images</span> based on clues.<br>
            ⏳ <strong>Time Limit:</strong> 15 seconds per image<br>
            🎯 <strong>Requirement:</strong> Score at least <span class="highlight">9/10</span> to qualify.<br>
            🔑 <strong>Reward:</strong> A <span class="highlight">unique password</span> for Level 5.<br>
             🖼  <strong>Database:</strong> Stores images, clues, and answers.</p>
          <div class="secionLine lineColorOrange"></div>
        </div>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead"><br>Level 5: The Final Clue | Memory Game & Prize Chest </h6>
          <p class="serviceDetails"> <br>📌 <strong>Objective:</strong> Match pairs within <span class="highlight">90 seconds</span>.<br>
            🎯 <strong>Scoring:</strong> Based on time taken & attempts.<br>
            🏆 <strong>Winner Ranking:</strong> Top <span class="highlight">5 winners</span> get special prizes.<br>
            💰 <strong>Prize Distribution:</strong><br>
            <ul>
                <li>🥇 <strong>1st Place:</strong> Grand Prize 🎖</li>
                <li>🥈 <strong>2nd to 5th Place:</strong> Smaller Prizes 🎁</li>
            </ul>
          <div class="secionLine lineColorOrange"></div>
        </div>

      </div>



      <div class="serviceLeadingSection">
        <h4><span class="sn lightGreen">3.</span><span class="st lightGreen">Lorem ipsum</span></h4>
        <p class="spl">Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
          Explicabo expedita minima architecto adipisci atque neque libero 
          facilis officia blanditiis provident 
          repudiandae numquam earum dolorem hic quis ipsa, a quisquam placeat:</p>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead">Some service info</h6>
          <p class="serviceDetails">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Perferendis repellendus rem quas eius, deleniti quos pariatur earum nihil voluptate inventore 
            vel atque possimus labore laborum, reprehenderit maxime, placeat quo corrupti.</p>
          <div class="secionLine lineColorGreen"></div>
        </div>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead">Some service info</h6>
          <p class="serviceDetails">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Perferendis repellendus rem quas eius, deleniti quos pariatur earum nihil voluptate inventore 
            vel atque possimus labore laborum, reprehenderit maxime, placeat quo corrupti.</p>
          <div class="secionLine lineColorGreen"></div>
        </div>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead">Some service info</h6>
          <p class="serviceDetails">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Perferendis repellendus rem quas eius, deleniti quos pariatur earum nihil voluptate inventore 
            vel atque possimus labore laborum, reprehenderit maxime, placeat quo corrupti.</p>
          <div class="secionLine lineColorGreen"></div>
        </div>        
      </div> 
      <div class="serviceLeadingSection">
        <h4><span class="sn purple">4.</span><span class="st purple">Lorem ipsum</span></h4>
        <p class="spl">Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
          Explicabo expedita minima architecto adipisci atque neque libero 
          facilis officia blanditiis provident 
          repudiandae numquam earum dolorem hic quis ipsa, a quisquam placeat:</p>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead">Some service info</h6>
          <p class="serviceDetails">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Perferendis repellendus rem quas eius, deleniti quos pariatur earum nihil voluptate inventore 
            vel atque possimus labore laborum, reprehenderit maxime, placeat quo corrupti.</p>
          <div class="secionLine lineColorPurple"></div>
        </div>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead">Some service info</h6>
          <p class="serviceDetails">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Perferendis repellendus rem quas eius, deleniti quos pariatur earum nihil voluptate inventore 
            vel atque possimus labore laborum, reprehenderit maxime, placeat quo corrupti.</p>
          <div class="secionLine lineColorPurple"></div>
        </div>
        <div class="serviceInfoContainer">
          <h6 class="serviceLead">Some service info</h6>
          <p class="serviceDetails">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Perferendis repellendus rem quas eius, deleniti quos pariatur earum nihil voluptate inventore 
            vel atque possimus labore laborum, reprehenderit maxime, placeat quo corrupti.</p>
          <div class="secionLine lineColorPurple"></div>
        </div>        
      </div>    
      <h4 class="closeTerms">CLOSE TERMS AND CONDITIONS</h4>
    </div>
  </body>
</html>