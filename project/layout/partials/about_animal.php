<?php
include 'database.php';

if (isset($_GET['animal_id'])) {
    $animal_id = $_GET['animal_id'];

    $animalQuery = "SELECT * FROM animaltable WHERE animal_id = $animal_id";
    $animalResult = mysqli_query($connection, $animalQuery);

    if ($animalResult) {
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
}

?>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <a href="?page=index">
                <button class="btn btn-light p-4 custom-return-button btn-square">
                    <i class="bi bi-arrow-return-left fs-1"></i>
                </button>
            </a>
            <div class="card-body px-lg-17 pt-lg-17 pb-lg-3">
                <div class="text-center mb-5">
                    <h3 class="fs-2hx text-dark mb-5"><?php echo $animal_name ?>ს შესახებ</h3>
                </div>

                <?php if (isset($thumbnailURL)) : ?>
                    <div class="mb-18 d-flex flex-column flex-md-row">
                        <a class="mx-auto mx-md-0 mb-md-0 mb-5" data-fslightbox="lightbox-animal-gallery" href="<?php echo $thumbnailURL; ?>">
                            <img class="custom-image mb-0 me-md-10 me-0" src="<?php echo $thumbnailURL; ?>" alt="Thumbnail Image">
                        </a>
                        <div class="fs-5 p-5 fw-semibold text-gray-600 border-1 border-dashed card-rounded">
                            <p class="custom-paragraph mb-0"><?php echo $description; ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($imageURLs)) : ?>
                    <div class="mb-16">
                        <h1 class="fw-bold text-gray-800 mb-10 text-center">გალერეა</h1>
                        <div class="d-flex justify-content-center g-10">
                            <?php foreach ($imageURLs as $imageURL) : ?>
                                <div class="custom-image-roll">
                                    <div class="card-xl-stretch mx-md-3">
                                        <a class="d-block overlay mb-4 d-flex justify-content-center" data-fslightbox="lightbox-animal-gallery" href="<?php echo $imageURL; ?>">
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px" style="background-image:url('<?php echo $imageURL; ?>'); width: 80%;"></div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="d-flex align-items-center border-1 border-dashed card-rounded p-5 p-lg-10 mb-14">
                    <div class="text-center flex-shrink-0 me-7 mx-lg-13">
                        <div class="symbol symbol-70px symbol-circle mb-2">
                            <img src="<?php echo $ownerProfilePicture; ?>" class="" alt="Owner's Profile Picture" />
                        </div>
                        <div class="mb-0">
                            <p class="text-gray-700 fw-bold text-hover-primary"><?php echo $ownerUsername; ?></p>
                        </div>
                    </div>
                    <div class="mb-0 fs-6 w-100">
                        <div class="text-center mb-5">
                            <h1 class="text-dark mb-5">საკონტაქტო ინფორმაცია</h1>
                        </div>
                        <div class="text-muted text-center fw-semibold lh-lg mb-2"><?php echo $contact_info ?></div>
                        <div class="text-muted text-center fw-semibold lh-lg mb-2">განთავსების თარიღი: <?php echo $animalCreationDate ?></div>
                        <!-- <a href="../../demo1/dist/pages/user-profile/overview.html" class="fw-semibold link-primary">Author’s Profile</a> -->
                    </div>
                </div>
                <?php
                if (!empty($patronDataArray)) {
                ?>
                    <div class="mb-5">
                        <div class="text-center mb-12">
                            <h3 class="fs-2hx text-dark mb-5">მეურვეები:</h3>
                            <div class="fs-5 text-muted fw-semibold">უღრმესი მადლობა რომ ეხმარებით <?php echo $animal_name; ?>ს!</div>
                        </div>
                        <div class="tns tns-default mb-10">
                            <div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000" data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true" data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false" data-tns-prev-button="#kt_team_slider_prev" data-tns-next-button="#kt_team_slider_next" data-tns-responsive="{1200: {items: 3}, 992: {items: 2}}">
                                <?php
                                foreach ($patronDataArray as $patron) {
                                    echo '<div class="text-center">';
                                    echo '<div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center" style="background-image:url(\'' . $patron['profile_picture'] . '\')"></div>';
                                    echo '<div class="mb-0">';
                                    echo '<p class="text-dark fw-bold text-hover-primary fs-3">' . $patron['username'] . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                            <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev">
                                <i class="bi bi-caret-left-fill fs-1"></i>
                            </button>
                            <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next">
                                <i class="bi bi-caret-right-fill fs-1"></i>
                            </button>
                        </div>
                    </div>
                <?php } ?>
                <div class="m-0 px-lg-17 pb-lg-17 p-5">
                    <h1 class="fw-bold text-gray-800 mb-5 text-center">გადახდის მეთოდი</h1>
                    <div class="d-flex flex-equal gap-5 gap-xxl-9 px-0 mb-12" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                        <label class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4" data-kt-button="true">
                            <input class="btn-check" type="radio" name="method" value="0" />
                            <i class="bi bi-cash fs-1"></i>
                            <span class="fs-7 fw-bold d-block">ქეშით</span>
                        </label>
                        <label class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4 active" data-kt-button="true">
                            <input class="btn-check" type="radio" name="method" value="1" />
                            <i class="bi bi-credit-card fs-1"></i>
                            <span class="fs-7 fw-bold d-block">ბარათით</span>
                        </label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary fs-1 fw-bold w-75 py-4" id="support-button">გახდი მეურვე</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("support-button").addEventListener("click", function() {
                var userId = <?php echo json_encode($_SESSION['user_id']); ?>;

                var animalId = <?php echo json_encode($_GET['animal_id']); ?>;

                var xhr = new XMLHttpRequest();

                xhr.open("POST", "take_patronage.php", true);

                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                    }
                };
                xhr.onerror = function() {
                    console.error("Request failed");
                };

                xhr.send("userId=" + userId + "&animalId=" + animalId);
            });
        });
    </script>