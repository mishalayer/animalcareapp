<?php
session_start();

include "database.php"; // Include your database connection

if (isset($_POST['submit']) && $_POST['submit'] == 1) {
    // Process other form fields
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = !empty($_POST['password']) ? password_hash(mysqli_real_escape_string($connection, $_POST['password']), PASSWORD_DEFAULT) : null;
    $description = isset($_POST['description']) ? mysqli_real_escape_string($connection, $_POST['description']) : '';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

    // Start a transaction to ensure data consistency
    mysqli_begin_transaction($connection);

    try {
        // Update user table
        $updateUserQuery = "UPDATE users SET username='$username', mail='$email', description='$description'";

        // Only update password if provided
        if ($password !== null) {
            $updateUserQuery .= ", password='$password'";
        }

        $updateUserQuery .= " WHERE id=$user_id";

        // Execute the query
        mysqli_query($connection, $updateUserQuery);

        // Delete all other old pictures associated with the user
        $deleteOldPicturesQuery = "DELETE FROM userpictures WHERE user_id = $user_id";
        mysqli_query($connection, $deleteOldPicturesQuery);

        // Handle image upload
        if (!empty($_FILES['avatar']['name'])) {
            $picturePath = $_SESSION['picture_path'];

            if (file_exists($picturePath)) {
                unlink($picturePath);
            }
            $imageName = uniqid('user_avatar_') . '.' . pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $targetPath = 'images/person_images/' . $imageName;

            // Move the uploaded file to the target path
            move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath);

            // Update the userpictures table
            $updatePictureQuery = "INSERT INTO userpictures (pict_name, user_id) VALUES ('$imageName', $user_id)";
            mysqli_query($connection, $updatePictureQuery);
            $_SESSION['picture_path'] = 'images/person_images/' . $imageName;
        } elseif ($_POST['avatar_remove'] == 1) {
            // Remove the profile picture from the database
            $removePictureQuery = "DELETE FROM userpictures WHERE user_id = $user_id";
            mysqli_query($connection, $removePictureQuery);

            // Additional code: Remove the file from the folder
            $picturePath = $_SESSION['picture_path'];

            if (file_exists($picturePath)) {
                unlink($picturePath);
            }
            $_SESSION['picture_path'] = 'NULL';
        }
        $_SESSION['username'] = $username;
        $_SESSION['mail'] = $email;
        $_SESSION['description'] = $description;

        mysqli_commit($connection);

        $response = ['status' => 'success', 'message' => 'Profile updated successfully'];
    } catch (Exception $e) {
        mysqli_rollback($connection);

        $response = ['status' => 'error', 'message' => 'An error occurred during the update: ' . $e->getMessage()];
    }
} else {
    $response = ['status' => 'error', 'message' => 'Invalid request'];
}

mysqli_close($connection);

header('Content-Type: application/json');

echo json_encode($response);
