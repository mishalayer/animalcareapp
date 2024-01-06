<?php
include "database.php";

$data = json_decode(file_get_contents("php://input"), true);

if ($data !== null) {
    $username = mysqli_real_escape_string($connection, $data['username']);
    $password = mysqli_real_escape_string($connection, $data['password']);

    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = mysqli_query($connection, $checkQuery);

    if ($checkResult) {
        if (mysqli_num_rows($checkResult) > 0) {
            $response = array('status' => 'error', 'message' => 'მომხმარებელი ასეთი სახელით უკვე არსებობს');
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insertQuery = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
            $insertResult = mysqli_query($connection, $insertQuery);

            if ($insertResult) {
                $logs_query = "INSERT INTO logs (object, action, initiator) VALUES ('$username', 'მომხმარებლის რეგისტრაცია', '$username');";
                mysqli_query($connection, $logs_query);
                $response = array('status' => 'success', 'message' => 'თქვენ წარმატებით გაიარეთ რეგისტრაცია', 'redirect' => 'animalcareapp/project/sign_in.php');
            } else {
                $response = array('status' => 'error', 'message' => 'რეგისტრაცია წარუმატებელია: ' . mysqli_error($connection));
            }
        }
    } else {
        $response = array('status' => 'error', 'message' => 'მონაცემთა ბაზის შეცდომა: ' . mysqli_error($connection));
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid JSON data');
}

mysqli_close($connection);
header('Content-Type: application/json');
echo json_encode($response);
