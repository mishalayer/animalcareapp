<?php
session_start();
include "database.php";

function typeChooser($text)
{
    if ($text == "dog") {
        echo "ძაღლი";
    } else if ($text == "cat") {
        echo "კატა";
    } else if ($text == "parrot") {
        echo "თუთიყუში";
    } else {
        echo "სხვა";
    }
}

function truncateText($text, $numWords)
{
    $words = explode(' ', $text);
    return implode(' ', array_slice($words, 0, $numWords));
}

$user_id = $_SESSION['user_id'];

$query = "SELECT COUNT(*) as total FROM animaltable WHERE owner_id = '$user_id'";

$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

$animalCount = $row['total'];

$sql = "SELECT a.animal_id, a.name, a.creation_date, a.animal_type, ap.pict_name
        FROM animaltable a
        JOIN animalpictures ap ON a.animal_id = ap.animal_id
        WHERE ap.is_thumbnail = 1 AND a.owner_id = '$user_id'";

$result = mysqli_query($connection, $sql);

ob_start();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $animalId = $row['animal_id'];
        $animalName = $row['name'];
        $animalType = $row['animal_type'];
        $animalCreationDate = $row['creation_date'];
        $thumbnailImage = $row['pict_name'];
?>
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    <a href="?page=about_animal&animal_id=<?php echo $animalId; ?>" class="symbol symbol-45px me-5">
                        <img src="images/animal_images/<?php echo $thumbnailImage; ?>" style="object-fit: cover;" />
                    </a>
                    <div class="d-flex justify-content-start flex-column">
                        <a href="?page=about_animal&animal_id=<?php echo $animalId; ?>" class="text-dark fw-bold text-hover-primary fs-6"><?php echo $animalName; ?></a>
                    </div>
                </div>
            </td>
            <td>
                <span class="text-dark fw-semibold d-block fs-6"><?php echo $animalCreationDate; ?></span>
            </td>
            <td>
                <span class="text-dark fw-semibold d-block fs-6"><?php echo typeChooser($animalType); ?></span>
            </td>
            <td>
                <div class="d-flex justify-content-end flex-shrink-0">
                    <a href="?page=edit_animal&animal_id=<?php echo $animalId; ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                        <i class="bi bi-pencil-square fs-2"></i>
                    </a>
                    <button class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete-element-button" data-bs-toggle="modal" data-bs-target="#delete_element_modal" data-bs-data="<?php echo $animalName; ?>" data-bs-image="images/animal_images/<?php echo $thumbnailImage; ?>" data-bs-id="<?php echo $animalId; ?>">
                        <i class="bi bi-trash-fill fs-2"></i>
                    </button>
                </div>
            </td>
        </tr>
    <?php
    }
} else {
    ?>
    <tr>
        <td colspan="4" class="p-20 fs-1 fw-bold text-gray-600 text-center">თქვენ არ გაქვთ ცხოველის განცხადება</td>
    </tr>
<?php
}
$content = ob_get_clean();

echo json_encode(array('content' => $content, 'animalCount' => $animalCount));
?>