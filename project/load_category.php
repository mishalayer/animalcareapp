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
echo $content;
?>