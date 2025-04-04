<?php
include '../../config.php';

$result = $conn->query("SELECT * FROM level4_identification ORDER BY RAND() LIMIT 10");
$questions = [];

while ($row = $result->fetch_assoc()) {
    $questions[] = [
        "id" => $row["id"],
        "clue" => $row["clue"],
        "image_path" => $row["image_path"],
        "option_1" => $row["option_1"],
        "option_2" => $row["option_2"],
        "option_3" => $row["option_3"],
        "option_4" => $row["option_4"]
    ];
}

echo json_encode($questions);
?>
