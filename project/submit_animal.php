<?php
session_start();
include "database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $contact_info = mysqli_real_escape_string($connection, $_POST['contact_info']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $owner_id = mysqli_real_escape_string($connection, $_POST['owner_id']);

    // Insert data into animal table
    $insertAnimalQuery = "INSERT INTO animaltable (name, contact_info, description, owner_id) VALUES ('$name', '$contact_info', '$description', '$owner_id')";
    mysqli_query($connection, $insertAnimalQuery);

    $animalId = mysqli_insert_id($connection);

    // Define the target folder
    $targetFolder = 'images/animal_images/';

    // Process each uploaded file
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
        $fileName = uniqid() . "_" . $_FILES['file']['name'][$i];
        $filePath = $targetFolder . $fileName;

        // Move the file to the target folder
        move_uploaded_file($_FILES['file']['tmp_name'][$i], $filePath);

        // Determine if it's a thumbnail
        $is_thumbnail = ($_POST['is_thumbnail'][$i] == 1) ? 1 : 0;

        // Insert data into animalpictures
        $insertPictureQuery = "INSERT INTO animalpictures (pict_name, animal_id, is_thumbnail) VALUES ('$fileName', '$animalId', '$is_thumbnail')";
        mysqli_query($connection, $insertPictureQuery);
    }

    echo json_encode(['status' => 'success', 'message' => 'Animal and images uploaded successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

mysqli_close($connection);
