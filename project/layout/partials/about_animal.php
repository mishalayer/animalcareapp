<?php
include 'database.php';

if (isset($_GET['animal_id'])) {
    $animal_id = $_GET['animal_id'];

    $animalQuery = "SELECT * FROM animaltable WHERE animal_id = $animal_id";
    $animalResult = mysqli_query($connection, $animalQuery);

    if ($animalResult and mysqli_num_rows($animalResult) > 0) {
        $animalData = mysqli_fetch_assoc($animalResult);
        $animal_name = $animalData['name'];
        $description = $animalData['description'];
        $animalCreationDate = $animalData['creation_date'];
        $contact_info = $animalData['contact_info'];
        $owner_id = $animalData['owner_id'];

        $ownerPictureQuery = "SELECT pict_name FROM userpictures WHERE user_id = $owner_id";
        $ownerPictureResult = mysqli_query($connection, $ownerPictureQuery);

        if ($ownerPictureResult) {
            if (mysqli_num_rows($ownerPictureResult) > 0) {
                $ownerPictureData = mysqli_fetch_assoc($ownerPictureResult);
                $ownerProfilePicture = 'images/person_images/' . $ownerPictureData['pict_name'];
            } else {
                $ownerProfilePicture = 'images/person_images/defaultprofile.png';
            }
        }

        $ownerUsernameQuery = "SELECT username FROM users WHERE id = $owner_id";
        $ownerUsernameResult = mysqli_query($connection, $ownerUsernameQuery);

        if ($ownerUsernameResult) {
            $ownerUsernameData = mysqli_fetch_assoc($ownerUsernameResult);
            $ownerUsername = $ownerUsernameData['username'];
        }

        $imagesQuery = "SELECT * FROM animalpictures WHERE animal_id = $animal_id";
        $imagesResult = mysqli_query($connection, $imagesQuery);
        $imageURLs = [];

        if ($imagesResult) {
            while ($imageData = mysqli_fetch_assoc($imagesResult)) {
                if ($imageData['is_thumbnail'] == 1) {
                    $thumbnailURL = 'images/animal_images/' . $imageData['pict_name'];
                } else {
                    $imageURLs[] = 'images/animal_images/' . $imageData['pict_name'];
                }
            }
        }
        $patronQuery = "SELECT * FROM patrontable WHERE animal_id = $animal_id";
        $patronResult = mysqli_query($connection, $patronQuery);

        if ($patronResult) {
            $patronDataArray = [];

            while ($patronData = mysqli_fetch_assoc($patronResult)) {
                $patronUserId = $patronData['patron_id'];

                $usernameQuery = "SELECT username FROM users WHERE id = $patronUserId";
                $usernameResult = mysqli_query($connection, $usernameQuery);

                if ($usernameResult && $usernameData = mysqli_fetch_assoc($usernameResult)) {
                    $patronData['username'] = $usernameData['username'];
                }

                $profilePictureQuery = "SELECT pict_name FROM userpictures WHERE user_id = $patronUserId";
                $profilePictureResult = mysqli_query($connection, $profilePictureQuery);

                if ($profilePictureResult) {
                    if (mysqli_num_rows($profilePictureResult) > 0) {
                        $profilePictureData = mysqli_fetch_assoc($profilePictureResult);
                        $patronData['profile_picture'] = 'images/person_images/' . $profilePictureData['pict_name'];
                    } else {
                        $patronData['profile_picture'] = 'images/person_images/defaultprofile.png';
                    }
                }

                $patronDataArray[] = $patronData;
            }
        }
        include 'about_animal_success.php';
    } else {
        include 'about_animal_fail.php';
    }
}
