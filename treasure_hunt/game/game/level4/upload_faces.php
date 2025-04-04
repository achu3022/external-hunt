<?php
session_start();
include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clue = $_POST['clue'];
    $target_dir = "uploads/faces/"; // Directory to store images
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Allowed file types
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Only JPG, JPEG, PNG, & GIF files are allowed.");
    }

    // Move uploaded file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_url = "uploads/faces/" . basename($_FILES["image"]["name"]);

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO level4_identification (image_url, clue, correct_answer) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $image_url, $clue, $_POST['correct_answer']);
        $stmt->execute();
        echo "Face added successfully!";
    } else {
        echo "Failed to upload file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Faces for Level 4</title>
</head>
<body>
    <h2>Upload Face Image</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Upload Image:</label>
        <input type="file" name="image" required><br>
        <label>Clue:</label>
        <input type="text" name="clue" required><br>
        <label>Correct Answer (Name):</label>
        <input type="text" name="correct_answer" required><br>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
