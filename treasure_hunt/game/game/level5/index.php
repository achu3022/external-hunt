<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mystery Box Challenge</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e2f;
            color: white;
            text-align: center;
            padding: 50px;
        }

        .container {
            background: #29293d;
            border-radius: 10px;
            padding: 20px;
            width: 50%;
            margin: auto;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        }

        h2 {
            font-size: 24px;
        }

        .mystery-box {
            background: url('lock-icon.png') no-repeat center;
            background-size: 50px;
            width: 80px;
            height: 80px;
            margin: 20px auto;
            border: 4px solid #ffcc00;
            border-radius: 10px;
        }

        input {
            padding: 10px;
            font-size: 16px;
            width: 80%;
            margin: 10px;
            border-radius: 5px;
            border: none;
            text-align: center;
        }

        button {
            background: #ffcc00;
            color: black;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #e6b800;
        }

        #hint {
            font-style: italic;
            margin-top: 10px;
            color: #bbbbbb;
        }

        #message {
            font-weight: bold;
            margin-top: 10px;
        }

        .unlocked {
            animation: unlockAnimation 1s forwards;
        }

        @keyframes unlockAnimation {
            from { transform: scale(1); }
            to { transform: scale(1.2); background: url('open-lock.png') no-repeat center; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Mystery Box Challenge</h2>
        <div class="mystery-box" id="box"></div>
        <p id="question">Loading question...</p>
        <input type="text" id="answer" placeholder="Enter answer">
        <button onclick="submitAnswer()">Submit</button>
        <p id="hint"></p>
        <p id="message"></p>
    </div>

    <script>
        let questionId = null;  // Store question ID globally

        function loadQuestion() {
            $.getJSON("fetch_mystery_box.php", function(data) {
                if (data.error) {
                    $("#question").text("❌ No questions available.");
                } else {
                    questionId = data.id; // Store question ID
                    $("#question").text(data.question);
                    $("#hint").text("Hint: " + data.hint);
                }
            });
        }

        function submitAnswer() {
            let answer = $("#answer").val().trim().toLowerCase();

            if (!questionId) {
                $("#message").text("❌ No question loaded.");
                return;
            }

            $.post("check_mystery_answer.php", { answer: answer, question_id: questionId }, function(response) {
                $("#message").text(response.message);

                if (response.success) {
                    $("#box").addClass("unlocked");  
                    setTimeout(() => { window.location.href = "memory_game.php"; }, 2000);
                }
            }, "json");
        }

        $(document).ready(loadQuestion);
    </script>
</body>
</html>
