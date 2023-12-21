<?php
session_start();

include "database.php";

if (isset($_POST['submit']) && $_POST['submit'] == 1) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = !empty($_POST['password']) ? password_hash(mysqli_real_escape_string($connection, $_POST['password']), PASSWORD_DEFAULT) : null;
    $description = isset($_POST['description']) ? mysqli_real_escape_string($connection, $_POST['description']) : '';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

    mysqli_begin_transaction($connection);

    try {
        $updateUserQuery = "UPDATE users SET mail='$email', description='$description'";

        if ($password !== null) {
            $updateUserQuery .= ", password='$password'";
        }

        $updateUserQuery .= " WHERE id=$user_id";

        mysqli_query($connection, $updateUserQuery);

        $deleteOldPicturesQuery = "DELETE FROM userpictures WHERE user_id = $user_id";
        mysqli_query($connection, $deleteOldPicturesQuery);

        if (!empty($_FILES['avatar']['name'])) {
            $picturePath = $_SESSION['picture_path'];

            if (file_exists($picturePath)) {
                unlink($picturePath);
            }
            $imageName = uniqid('user_avatar_') . '.' . pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $targetPath = 'images/person_images/' . $imageName;

            move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath);

            $updatePictureQuery = "INSERT INTO userpictures (pict_name, user_id) VALUES ('$imageName', $user_id)";
            mysqli_query($connection, $updatePictureQuery);
            $_SESSION['picture_path'] = 'images/person_images/' . $imageName;
        } elseif ($_POST['avatar_remove'] == 1) {
            $removePictureQuery = "DELETE FROM userpictures WHERE user_id = $user_id";
            mysqli_query($connection, $removePictureQuery);

            $picturePath = $_SESSION['picture_path'];

            if (file_exists($picturePath)) {
                unlink($picturePath);
            }
            $_SESSION['picture_path'] = 'NULL';
        }
        $_SESSION['mail'] = $email;
        $_SESSION['description'] = $description;

        mysqli_commit($connection);

        $logs_query = "INSERT INTO logs (object, action, initiator) VALUES ('" . $_SESSION['username'] . "', 'პროფილის განახლება', '" . $_SESSION['username'] ."');";
        mysqli_query($connection, $logs_query);
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
