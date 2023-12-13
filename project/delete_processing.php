<?php

include 'database.php';

$userId = $_POST['userId'];

$query = "DELETE FROM usertable WHERE user_id = '$userId';";

if (mysqli_query($connection, $query)) {
    $response = array("status" => "success", "message" => "User deleted successfully");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Error deleting user: " . mysqli_error($connection));
    echo json_encode($response);
}

mysqli_close($connection);
