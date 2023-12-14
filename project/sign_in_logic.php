<?php
include "database.php";

$data = json_decode(file_get_contents("php://input"), true);

if ($data !== null) {
    $username = mysqli_real_escape_string($connection, $data['username']);
    $password = mysqli_real_escape_string($connection, $data['password']);
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        session_start();
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['privilege'] = $row['privilege'];
        $_SESSION['loggedin'] = true;
        $response = array('status' => 'success', 'message' => 'ავტორიზაცია წარმატებით შესრულდა', 'redirect' => 'animalcareapp/project/index.php');
    } else {
        $response = array('status' => 'error', 'message' => 'ავტორიზაციის შეცდომა');
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid JSON data');
}

mysqli_close($connection);
header('Content-Type: application/json');
echo json_encode($response);
