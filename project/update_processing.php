<?php

include 'database.php';


$userId = $_POST['userId'];
$room = $_POST['room'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$tel = $_POST['tel'];
$mobile = $_POST['mobile'];
$group_id = $_POST['group_id'];

if ($group_id == "NULL") {
    $query = "UPDATE usertable SET 
room = '$room', 
name = '$name', 
surname = '$surname', 
tel = '$tel', 
mobile = '$mobile', 
group_id = NULL 
WHERE user_id = '$userId';";
} else {
    $query = "UPDATE usertable SET 
room = '$room', 
name = '$name', 
surname = '$surname', 
tel = '$tel', 
mobile = '$mobile', 
group_id = '$group_id' 
WHERE user_id = '$userId';";
}

if (mysqli_query($connection, $query)) {
    $response = array("status" => "success", "message" => "Data updated successfully");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Error inserting data: " . mysqli_error($connection));
    echo json_encode($response);
}

mysqli_close($connection);
