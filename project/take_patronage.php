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

if (!ctype_digit($animalId) || $animalId <= 0) {
    http_response_code(400);
    echo "Invalid animal ID";
    exit();
}

$checkPatronageQuery = "SELECT * FROM patrontable WHERE animal_id = $animalId AND patron_id = $userId";
$checkPatronageResult = mysqli_query($connection, $checkPatronageQuery);

if ($checkPatronageResult && mysqli_num_rows($checkPatronageResult) > 0) {
    http_response_code(200);
    echo "User already supports the animal";
    exit();
}

$insertPatronageQuery = "INSERT INTO patrontable (animal_id, patron_id) VALUES ($animalId, $userId)";

if (mysqli_query($connection, $insertPatronageQuery)) {
    http_response_code(200);
    echo "Patronage information added successfully";
} else {
    http_response_code(500);
    echo "Error adding patronage information: " . mysqli_error($connection);
}

mysqli_close($connection);
