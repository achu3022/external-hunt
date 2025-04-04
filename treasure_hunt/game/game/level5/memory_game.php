<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Game</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e2f;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .container {
            width: 50%;
            margin: auto;
            background: #29293d;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        }

        h2 {
            font-size: 24px;
        }

        #grid {
            display: grid;
            grid-template-columns: repeat(4, 80px);
            grid-gap: 10px;
            justify-content: center;
            margin: 20px auto;
        }

        .card {
            width: 80px;
            height: 80px;
            background: #444;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            cursor: pointer;
            transition: transform 0.3s, background 0.3s;
        }

        .card.flipped {
            background: #ffcc00;
            color: black;
            transform: rotateY(180deg);
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        #timer {
            font-weight: bold;
            color: #ffcc00;
        }

        #attempts {
            font-weight: bold;
            color: #ff6666;
        }

        #message {
            font-size: 20px;
            font-weight: bold;
            color: red;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Memory Game</h2>
        <div id="grid"></div>
        <p>Attempts: <span id="attempts">0</span></p>
        <p>Time: <span id="timer">90</span> sec</p>
        <p id="message"></p>
    </div>

    <script>
        let attempts = 0;
        let timeLeft = 90;
        let gameOver = false;
        let cardSymbols = ["🍎", "🍎", "🍌", "🍌", "🍇", "🍇", "🍉", "🍉", "🍓", "🍓", "🥝", "🥝", "🍒", "🍒", "🍍", "🍍"];
        let flippedCards = [];
        let matchedPairs = 0;

        let timer = setInterval(() => {
            if (gameOver) return;
            timeLeft--;
            $("#timer").text(timeLeft);

            if (timeLeft === 0) {
                endGame(false);
            }
        }, 1000);

        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                let j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        function createGrid() {
            shuffle(cardSymbols);
            for (let symbol of cardSymbols) {
                let card = $("<div>").addClass("card").data("symbol", symbol);
                card.on("click", flipCard);
                $("#grid").append(card);
            }
        }

        function flipCard() {
            if (gameOver || $(this).hasClass("flipped") || flippedCards.length >= 2) return;

            $(this).text($(this).data("symbol")).addClass("flipped");
            flippedCards.push($(this));

            if (flippedCards.length === 2) {
                attempts++;
                $("#attempts").text(attempts);
                checkMatch();
            }
        }

        function checkMatch() {
            let [card1, card2] = flippedCards;
            if (card1.data("symbol") === card2.data("symbol")) {
                flippedCards = [];
                matchedPairs++;
                if (matchedPairs === cardSymbols.length / 2) endGame(true);
            } else {
                setTimeout(() => {
                    card1.text("").removeClass("flipped");
                    card2.text("").removeClass("flipped");
                    flippedCards = [];
                }, 1000);
            }
        }

        function endGame(success) {
            clearInterval(timer);
            gameOver = true;
            $(".card").off("click");

            if (!success) {
                $("#message").text("⏳ Time is up! Redirecting...").show();
            }

            $.post("save_memory_score.php", { attempts: attempts, success: success }, function() {
                setTimeout(() => {
                    if (success) {
                        window.location.href = "prizes.php";
                    } else {
                        window.location.href = "game_start.php";
                    }
                }, 2000);
            });
        }

        $(document).ready(createGrid);
    </script>
</body>
</html>
