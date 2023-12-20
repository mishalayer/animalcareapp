<?php
// Include your database connection file
include 'database.php';

// Assume you have started the session somewhere in your code
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo "User not logged in";
    exit();
}

// Get user ID from the session
$userId = $_SESSION['user_id'];

// Get animal ID from the POST request
$animalId = $_POST['animalId'];

// Validate that animal ID is a positive integer (adjust as needed)
if (!ctype_digit($animalId) || $animalId <= 0) {
    http_response_code(400);
    echo "Invalid animal ID";
    exit();
}

// Check if the user already supports the animal
$checkPatronageQuery = "SELECT * FROM patrontable WHERE animal_id = $animalId AND patron_id = $userId";
$checkPatronageResult = mysqli_query($connection, $checkPatronageQuery);

if ($checkPatronageResult && mysqli_num_rows($checkPatronageResult) > 0) {
    // The user already supports the animal, do nothing
    http_response_code(200);
    echo "User already supports the animal";
    exit();
}

// Insert patronage information into the database
$insertPatronageQuery = "INSERT INTO patrontable (animal_id, patron_id) VALUES ($animalId, $userId)";

if (mysqli_query($connection, $insertPatronageQuery)) {
    http_response_code(200);
    echo "Patronage information added successfully";
} else {
    http_response_code(500);
    echo "Error adding patronage information: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
