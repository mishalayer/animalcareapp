<?php
session_start();
include "database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animal_id = mysqli_real_escape_string($connection, $_POST['animal_id']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $contact_info = mysqli_real_escape_string($connection, $_POST['contact_info']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $owner_id = mysqli_real_escape_string($connection, $_POST['owner_id']);
    $animal_type = mysqli_real_escape_string($connection, $_POST['animal_type']);

    $imageQuery = "SELECT pict_name FROM animalpictures WHERE animal_id = '$animal_id';";
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
    $deletePictureQuery = "DELETE FROM animalpictures WHERE animal_id='$animal_id'";
    mysqli_query($connection, $deletePictureQuery);

    $updateAnimalQuery = "UPDATE animaltable 
                      SET name = '$name', 
                          contact_info = '$contact_info', 
                          description = '$description', 
                          animal_type = '$animal_type'
                      WHERE animal_id = $animal_id";

    mysqli_query($connection, $updateAnimalQuery);

    // Check if files are present in the request
    if (!empty($_FILES['file']['name'][0])) {
        // Continue with file handling logic

        $targetFolder = 'images/animal_images/';

        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            $fileName = uniqid() . "_" . $_FILES['file']['name'][$i];
            $filePath = $targetFolder . $fileName;

            move_uploaded_file($_FILES['file']['tmp_name'][$i], $filePath);

            $is_thumbnail = ($_POST['is_thumbnail'][$i] == 1) ? 1 : 0;

            $insertPictureQuery = "INSERT INTO animalpictures (pict_name, animal_id, is_thumbnail) VALUES ('$fileName', '$animal_id', '$is_thumbnail')";
            mysqli_query($connection, $insertPictureQuery);
        }
    }

    $logs_query = "INSERT INTO logs (object, action, initiator) VALUES ('" . "ცხოველის ID=" . $animal_id . " " . $name . "', 'ცხოველის რედაქტირება', '" . $_SESSION['username'] . "');";
    mysqli_query($connection, $logs_query);

    echo json_encode(['status' => 'success', 'message' => 'Animal listing updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

mysqli_close($connection);
