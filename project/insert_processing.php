<?php

include 'database.php';

$room = $_POST['room'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$tel = $_POST['tel'];
$mobile = $_POST['mobile'];
$group_id = $_POST['group_id'];

$query = "INSERT INTO usertable (room, name, surname, tel, mobile, group_id) VALUES ('$room', '$name', '$surname', '$tel', '$mobile', '$group_id')";

if (mysqli_query($connection, $query)) {
  $response = array("status" => "success", "message" => "Data inserted successfully");
  echo json_encode($response);
} else {
  $response = array("status" => "error", "message" => "Error inserting data: " . mysqli_error($connection));
  echo json_encode($response);
}

mysqli_close($connection);
