<?php
include('database.php');
$clearQuery = "DELETE FROM `groups`";
mysqli_query($connection, $clearQuery);
$data = json_decode(file_get_contents('php://input'), true);

foreach ($data as $element) {
    $id = mysqli_real_escape_string($connection, $element['id']);
    $parentId = mysqli_real_escape_string($connection, $element['parent_id']);
    $name = mysqli_real_escape_string($connection, $element['name']);
    $ord_id = mysqli_real_escape_string($connection, $element['ord_id']);

    $query = "INSERT INTO `groups` VALUES ($id, $parentId, '$name', '$ord_id')";
    mysqli_query($connection, $query);
}

$updateQuery = "UPDATE usertable SET group_id = NULL WHERE group_id IS NOT NULL AND group_id NOT IN (SELECT id FROM groups)";
mysqli_query($connection, $updateQuery);
mysqli_commit($connection);

echo 'Changes saved successfully';
