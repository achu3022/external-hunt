<?php
session_start();
include '../../config.php'; // Database connection

// Securely fetch user id
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header("Location: ../../../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level 4 - Guess Who</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background: url('level4bg.webp') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        #game-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            width: 40%;
            margin: auto;
            margin-top: 5%;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.3);
            color: white;
        }

        #image {
            width: 100%;
            max-width: 300px;
            height: auto;
            margin: 20px auto;
            display: block;
            border: 2px solid white;
            border-radius: 10px;
        }

        #timer {
            font-size: 24px;
            color: yellow;
            font-weight: bold;
        }

        select {
            padding: 10px;
            font-size: 18px;
            margin-top: 10px;
            width: 100%;
            border-radius: 5px;
            text-align: center;
        }

        #clue {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) { 
            #game-container {
                width: 60%;
            }
        }

        @media (max-width: 768px) { 
            #game-container {
                width: 80%;
                padding: 15px;
            }

            #clue {
                font-size: 20px;
            }

            select {
                font-size: 16px;
                padding: 8px;
            }

            #timer {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) { 
            #game-container {
                width: 90%;
                padding: 10px;
            }

            #clue {
                font-size: 18px;
            }

            select {
                font-size: 14px;
                padding: 6px;
            }

            #timer {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div id="game-container">
        <p id="clue"></p>
        <img id="image" src="" alt="Person's Image">
        <p>Identify the Person:</p>
        <select id="answer-select">
            <option value="">Select an Answer</option>
        </select>
        <p>Time Remaining: <span id="timer">15</span> seconds</p>
    </div>

    <script>
        let questions = [];
        let currentIndex = 0;
        let timer;

        function loadQuestions() {
            $.getJSON("fetch_questions.php", function(data) {
                questions = data;
                displayQuestion();
            });
        }

        function displayQuestion() {
            if (currentIndex >= questions.length) {
                window.location.href = "level4_result.php"; 
                return;
            }

            let q = questions[currentIndex];
            $("#clue").text(q.clue);
            $("#image").attr("src", q.image_path);
            $("#answer-select").empty().append('<option value="">Select an Answer</option>');
            $("#answer-select").append(`<option value="${q.option_1}">${q.option_1}</option>`);
            $("#answer-select").append(`<option value="${q.option_2}">${q.option_2}</option>`);
            $("#answer-select").append(`<option value="${q.option_3}">${q.option_3}</option>`);
            $("#answer-select").append(`<option value="${q.option_4}">${q.option_4}</option>`);

            startTimer();
        }

        function startTimer() {
            let timeLeft = 15;
            $("#timer").text(timeLeft);
            clearInterval(timer);

            timer = setInterval(() => {
                timeLeft--;
                $("#timer").text(timeLeft);
                if (timeLeft === 0) {
                    clearInterval(timer);
                    submitAnswer(""); // Auto-submit empty answer if time runs out
                }
            }, 1000);
        }

        $("#answer-select").change(function() {
            submitAnswer($(this).val());
        });

        function submitAnswer(answer) {
            clearInterval(timer);
            $.post("submit_answer.php", { question_id: questions[currentIndex].id, answer: answer }, function() {
                currentIndex++;
                displayQuestion();
            });
        }

        $(document).ready(function() {
            loadQuestions();
        });
    </script>
</body>
</html>
