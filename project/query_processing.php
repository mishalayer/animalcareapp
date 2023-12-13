<?php
include('database.php');

$selectedGroupId = isset($_GET['selectedGroupId']) ? $_GET['selectedGroupId'] : 0;

if ($selectedGroupId == 0) {
    $query = "WITH RECURSIVE groups_tree AS (
        SELECT
            g1.id,
            g1.parent_id,
            g1.name AS hierarchy_name,
            g1.ord_id,
            0 AS group_level
        FROM `groups` g1
        WHERE g1.parent_id = 0

        UNION ALL

        SELECT
            g2.id,
            g2.parent_id,
            CONCAT(gt.hierarchy_name, ' / ', g2.name) AS hierarchy_name,
            g2.ord_id,
            group_level + 1
        FROM `groups` g2
        JOIN groups_tree gt ON gt.id = g2.parent_id
    )

    SELECT
        u.room,
        u.name,
        u.surname,
        u.tel,
        u.mobile,
        gt.hierarchy_name,
        u.user_id,
        gt.id
    FROM usertable u
    JOIN groups_tree gt ON u.group_id = gt.id
    ORDER BY gt.ord_id;";
} else if ($selectedGroupId == "NULL") {
    $query = "SELECT room, name, surname, tel, mobile, group_id as hierarchy_name, user_id, group_id as id FROM usertable WHERE group_id IS NULL;";
} else {
    $query = "WITH RECURSIVE groups_tree AS (
        SELECT
            g1.id,
            g1.parent_id,
            g1.name AS hierarchy_name,
            g1.ord_id,
            0 AS group_level
        FROM `groups` g1
        WHERE g1.id = $selectedGroupId

        UNION ALL

        SELECT
            g2.id,
            g2.parent_id,
            CONCAT(gt.hierarchy_name, ' / ', g2.name) AS hierarchy_name,
            g2.ord_id,
            group_level + 1
        FROM `groups` g2
        JOIN groups_tree gt ON gt.id = g2.parent_id
    )

    SELECT
        u.room,
        u.name,
        u.surname,
        u.tel,
        u.mobile,
        gt.hierarchy_name,
        u.user_id,
        gt.id
    FROM usertable u
    JOIN groups_tree gt ON u.group_id = gt.id
    ORDER BY gt.ord_id;";
}

$result = mysqli_query($connection, $query);

$data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($data);
