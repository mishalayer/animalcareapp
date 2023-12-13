<?php
include 'database.php';

$selectedGroupId = isset($_GET['selectedGroupId']) ? $_GET['selectedGroupId'] : 0;

if ($selectedGroupId == "parentGroups") {
  $query = "SELECT id, name as hierarchy_name FROM `groups` WHERE parent_id = 0 ORDER BY ord_id;";
} else if ($selectedGroupId != 0) {
  $query = "WITH RECURSIVE groups_tree AS (
    SELECT
      g1.id,
      g1.parent_id,
      g1.name,
      CAST(g1.name AS CHAR CHARACTER SET utf32 COLLATE utf32_general_ci) AS hierarchy_name,
      g1.ord_id,
      0 AS group_level
    FROM `groups` g1
    WHERE g1.parent_id = $selectedGroupId
  
    UNION ALL
  
    SELECT
      g2.id,
      g2.parent_id,
      g2.name,
      CONCAT(gt.hierarchy_name COLLATE utf32_general_ci, ' / ', g2.name COLLATE utf32_general_ci) AS hierarchy_name,
      g2.ord_id,
      group_level + 1
    FROM `groups` g2
    JOIN groups_tree gt ON gt.id = g2.parent_id
  )
  
  SELECT id, hierarchy_name
  FROM groups_tree
  ORDER BY ord_id;";
} else {
  $query = "WITH RECURSIVE groups_tree AS (
    SELECT
      g1.id,
      g1.parent_id,
      g1.name,
      CAST(g1.name AS CHAR CHARACTER SET utf32 COLLATE utf32_general_ci) AS hierarchy_name,
      g1.ord_id,
      0 AS group_level
    FROM `groups` g1
    WHERE g1.parent_id = 0
  
    UNION ALL
  
    SELECT
      g2.id,
      g2.parent_id,
      g2.name,
      CONCAT(gt.hierarchy_name COLLATE utf32_general_ci, ' / ', g2.name COLLATE utf32_general_ci) AS hierarchy_name,
      g2.ord_id,
      group_level + 1
    FROM `groups` g2
    JOIN groups_tree gt ON gt.id = g2.parent_id
  )
  
  SELECT id, hierarchy_name
  FROM groups_tree
  ORDER BY ord_id;
";
}

$result = mysqli_query($connection, $query);

if ($result) {
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  header('Content-Type: application/json');
  echo json_encode($data);
} else {
  http_response_code(500);
  echo json_encode(['error' => 'Database error']);
}
