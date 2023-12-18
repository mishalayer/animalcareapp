<?php
include "database.php";

$data = json_decode(file_get_contents("php://input"), true);

if ($data !== null) {
    $username = mysqli_real_escape_string($connection, $data['username']);
    $password = mysqli_real_escape_string($connection, $data['password']);
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            session_start();
            $userId = $row['id'];
            $pictureQuery = "SELECT * FROM userpictures WHERE user_id = '$userId'";
            $pictureResult = mysqli_query($connection, $pictureQuery);

            if ($pictureRow = mysqli_fetch_assoc($pictureResult)) {
                $_SESSION['picture_path'] = 'images/person_images/' . $pictureRow['pict_name'];
            } else {
                $_SESSION['picture_path'] = 'NULL';
            }
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['mail'] = $row['mail'];
            $_SESSION['description'] = $row['description'];
            $_SESSION['registration_date'] = $row['registration_date'];
            $_SESSION['privilege'] = $row['privilege'];
            $_SESSION['loggedin'] = true;

            $response = array('status' => 'success', 'message' => 'ავტორიზაცია წარმატებით შესრულდა', 'redirect' => 'animalcareapp/project/index.php');
        } else {
            $response = array('status' => 'error', 'message' => 'ავტორიზაციის შეცდომა');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'ავტორიზაციის შეცდომა');
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid JSON data');
}

mysqli_close($connection);
header('Content-Type: application/json');
echo json_encode($response);
