<?php
session_start();
include '../config.php';

$result = $conn->query("SELECT * FROM level4_identification");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Uploaded Faces</title>
</head>
<body>
    <h2>Uploaded Faces</h2>
    <table border="1">
        <tr>
            <th>Image</th>
            <th>Clue</th>
            <th>Correct Answer</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><img src="../<?php echo $row['image_url']; ?>" width="100"></td>
                <td><?php echo $row['clue']; ?></td>
                <td><?php echo $row['correct_answer']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
