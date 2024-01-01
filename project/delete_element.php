<?php
include 'database.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo "User not logged in";
    exit();
}

$userId = $_SESSION['user_id'];

$animalId = $_POST['animalId'];
$animalQuery = "SELECT name FROM animaltable WHERE animal_id = $animalId";
$animalResult = mysqli_query($connection, $animalQuery);

if ($animalResult) {
    $animalData = mysqli_fetch_assoc($animalResult);
    $name = $animalData['name'];
}

if (!ctype_digit($animalId) || $animalId <= 0) {
    http_response_code(400);
    echo "Invalid animal ID";
    exit();
}

$checkOwnerQuery = "SELECT * FROM animaltable WHERE animal_id = $animalId AND owner_id = $userId";
$checkOwnerResult = mysqli_query($connection, $checkOwnerQuery);

if (!$checkOwnerResult || mysqli_num_rows($checkOwnerResult) === 0) {
    http_response_code(200);
    echo "User is not the owner of the animal";
    exit();
}

$imageQuery = "SELECT pict_name FROM animalpictures WHERE animal_id = $animalId";
$imageResult = mysqli_query($connection, $imageQuery);

if ($imageResult) {
    while ($imageRow = mysqli_fetch_assoc($imageResult)) {
        $imageName = $imageRow['pict_name'];
        $imageFullPath = "images/animal_images/" . $imageName;

        if (file_exists($imageFullPath)) {
            unlink($imageFullPath);
        }
    }
}

$removeAnimalQuery = "DELETE FROM animaltable WHERE animal_id = $animalId AND owner_id = $userId";

if (mysqli_query($connection, $removeAnimalQuery)) {
    $logs_query = "INSERT INTO logs (object, action, initiator) VALUES ('" . "ცხოველის ID=" . $animalId . " " . $name . "', 'განცხადების წაშლა', '" . $_SESSION['username'] . "');";
    mysqli_query($connection, $logs_query);
    http_response_code(200);
    echo "Animal listing removed successfully";
} else {
    http_response_code(500);
    echo "Error removing animal: " . mysqli_error($connection);
}

mysqli_close($connection);
