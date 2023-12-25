<?php
include "database.php";

function truncateText($text, $numWords)
{
    $words = explode(' ', $text);
    return implode(' ', array_slice($words, 0, $numWords));
}

$category = isset($_POST['category']) ? $_POST['category'] : 'all';
$sorting = isset($_POST['sorting']) ? $_POST['sorting'] : 'DESC';
$support = isset($_POST['support']) ? $_POST['support'] : 'all';

$query = "SELECT
COALESCE(COUNT(*), 0) AS total,
COALESCE(SUM(CASE WHEN animal_type = 'dog' THEN 1 ELSE 0 END), 0) AS dog_count,
COALESCE(SUM(CASE WHEN animal_type = 'cat' THEN 1 ELSE 0 END), 0) AS cat_count,
COALESCE(SUM(CASE WHEN animal_type = 'parrot' THEN 1 ELSE 0 END), 0) AS parrot_count,
COALESCE(SUM(CASE WHEN animal_type = 'other' THEN 1 ELSE 0 END), 0) AS other_count
FROM animaltable";
if ($support == 'without_support') {
    $query .= " WHERE animal_id NOT IN (SELECT animal_id FROM patrontable)";
} elseif ($support == 'with_support') {
    $query .= " WHERE animal_id IN (SELECT animal_id FROM patrontable)";
}
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

$allCategoryCount = $row['total'];
$dogCategoryCount = $row['dog_count'];
$catCategoryCount = $row['cat_count'];
$parrotCategoryCount = $row['parrot_count'];
$otherCategoryCount = $row['other_count'];

$counts = array(
    'total' => $allCategoryCount,
    'dog' => $dogCategoryCount,
    'cat' => $catCategoryCount,
    'parrot' => $parrotCategoryCount,
    'other' => $otherCategoryCount,
);

$sql = "SELECT a.*, ap.pict_name
        FROM animaltable a
        JOIN animalpictures ap ON a.animal_id = ap.animal_id
        WHERE ap.is_thumbnail = 1";

if ($support == 'without_support') {
    $sql .= " AND a.animal_id NOT IN (SELECT animal_id FROM patrontable)";
} elseif ($support == 'with_support') {
    $sql .= " AND a.animal_id IN (SELECT animal_id FROM patrontable)";
}

if ($category != 'all') {
    $sql .= " AND a.animal_type = '$category'";
}

$sql .= " ORDER BY a.animal_id $sorting";

$result = mysqli_query($connection, $sql);

ob_start();
while ($row = mysqli_fetch_assoc($result)) {
    $animalId = $row['animal_id'];
    $animalName = $row['name'];
    $animalCreationDate = $row['creation_date'];
    $description = truncateText($row['description'], 50);
    $thumbnailImage = $row['pict_name'];
?>
    <div class="card card-flush flex-row-fluid mw-23">
        <div class="card-header pt-3 px-6 pb-2 d-flex justify-content-center custom-card-header"><a class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1" href="index.php?page=about_animal&animal_id=<?php echo $animalId; ?>"><?php echo $animalName; ?></a></div>
        <div class="card-body text-center px-6 py-2 border-1 border-top-dashed border-bottom-dashed border-gray-300">
            <img src="images/animal_images/<?php echo $thumbnailImage; ?>" class="rounded-3 mb-4 w-150px h-150px w-xxl-200px h-xxl-200px" style="object-fit: cover;" alt="" />
            <div class="mb-2">
                <div class="text-center">
                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-n1 custom-span"><?php echo $description; ?></span>
                </div>
            </div>
            <a href="index.php?page=about_animal&animal_id=<?php echo $animalId; ?>" class="btn btn-primary fw-bold">დეტალურად</a>
        </div>
        <div class="card-footer pt-2 pb-2  d-flex justify-content-center text-gray-700"><?php echo $animalCreationDate; ?></div>
    </div>
<?php
}
$content = ob_get_clean();

echo json_encode(array('content' => $content, 'counts' => $counts));
?>