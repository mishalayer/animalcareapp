<?php
include "database.php";

function truncateText($text, $numWords)
{
    $words = explode(' ', $text);
    return implode(' ', array_slice($words, 0, $numWords));
}

$category = isset($_POST['category']) ? $_POST['category'] : 'all';

if ($category == 'all') {
    $sql = "SELECT a.*, ap.pict_name
            FROM animaltable a
            JOIN animalpictures ap ON a.animal_id = ap.animal_id
            WHERE ap.is_thumbnail = 1";
} else {
    $sql = "SELECT a.*, ap.pict_name
            FROM animaltable a
            JOIN animalpictures ap ON a.animal_id = ap.animal_id
            WHERE a.animal_type = '$category' AND ap.is_thumbnail = 1";
}

$result = mysqli_query($connection, $sql);

ob_start();
while ($row = mysqli_fetch_assoc($result)) {
    $animalId = $row['animal_id'];
    $animalName = $row['name'];
    $description = truncateText($row['description'], 50);
    $thumbnailImage = $row['pict_name'];
?>
    <div class="card card-flush flex-row-fluid p-6 pb-5 mw-23">
        <div class="card-body text-center">
            <img src="images/animal_images/<?php echo $thumbnailImage; ?>" class="rounded-3 mb-4 w-150px h-150px w-xxl-200px h-xxl-200px" alt="" />
            <div class="mb-2">
                <div class="text-center">
                    <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1"><?php echo $animalName; ?></span>
                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-n1 custom-span"><?php echo $description; ?></span>
                </div>
            </div>
            <a href="index.php?page=about_animal&animal_id=<?php echo $animalId; ?>" class="btn btn-primary fw-bold">დეტალურად</a>
        </div>
    </div>
<?php
}
$content = ob_get_clean();
echo $content;
?>