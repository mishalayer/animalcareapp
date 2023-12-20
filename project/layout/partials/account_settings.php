<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card mb-5 mb-xl-10">
            <a href="?page=index">
                <button class="btn btn-light p-4 custom-return-button btn-square">
                    <i class="bi bi-arrow-return-left fs-1"></i>
                </button>
            </a>
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#account_profile_details" aria-expanded="true" aria-controls="account_profile_details">
                <div class="card-title ps-20 m-0">
                    <h3 class="fw-bold m-0">მომხმარებლის მონაცემები</h3>
                </div>
            </div>
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form id="account_profile_details_form" class="form">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">პროფილის სურათი</label>
                            <div class="col-lg-8">
                                <div class="image-input image-input-outline <?php if ($_SESSION['picture_path'] === 'NULL') {
                                                                                echo "image-input-empty";
                                                                            } ?>" data-kt-image-input="true" style="background-image: url('images/person_images/defaultprofile.png')">
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: <?php echo ($_SESSION['picture_path'] === 'NULL') ? 'none' : 'url(' . $_SESSION['picture_path'] . ')'; ?>"></div>

                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" id="avatar_remove_input" value="0" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                </div>
                                <div class="form-text">მიიღება *.png, *.jpg ან *.jpeg გაფართოების ფაილი.</div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">მომხმარებლის სახელი</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="username" class="form-control form-control-lg form-control-solid" placeholder="სახელი" value="<?php echo ($_SESSION['username']); ?>" disabled />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">ელ-ფოსტა</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="email" class="form-control form-control-lg form-control-solid" placeholder="ელ-ფოსტა" value="<?php echo ($_SESSION['mail']); ?>" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">პაროლი</label>
                            <div class="col-lg-8 fv-row">
                                <input type="password" name="password" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">აღწერა</label>
                            <div class="col-lg-8 fv-row">
                                <div class="mb-2">
                                    <textarea name="description" class="form-control" id="description" style="height: 186px;" placeholder="აღწერა"><?php echo ($_SESSION['description']); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">რეგისტრაციის თარიღი</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="reg_date" class="form-control form-control-lg form-control-solid" placeholder="რეგისტრაციის თარიღი" value="<?php echo ($_SESSION['registration_date']); ?>" disabled />
                            </div>
                        </div>
                        <!-- <div class="row mb-0">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Allow Marketing</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                    <input class="form-check-input w-45px h-30px" type="checkbox" id="allowmarketing" checked="checked" />
                                    <label class="form-check-label" for="allowmarketing"></label>
                                </div>
                            </div>
                        </div>
                        -->
                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <a href="?" class="btn btn-light me-5">გაუქმება</a>
                        <button type="submit" class="btn btn-primary" id="account_settings_submit" name="submit" value="1">ცვლილებების შენახვა</button>
                        <input type="hidden" name="submit" value="1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('account_profile_details_form');
        var avatarRemoveInput = document.getElementById('avatar_remove_input');

        document.querySelector('[data-kt-image-input-action="cancel"]').addEventListener('click', function() {
            avatarRemoveInput.value = 0;
        });

        document.querySelector('[data-kt-image-input-action="remove"]').addEventListener('click', function() {
            avatarRemoveInput.value = 1;
        });

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();

            xhr.open('POST', 'update_profile.php', true);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    var response = JSON.parse(xhr.responseText);

                    if (response.status === 'success') {
                        console.log('Profile updated successfully');
                        location.reload();
                    } else {
                        console.error('Error updating profile:', response.message);
                    }
                } else {
                    console.error('Server error:', xhr.status, xhr.statusText);
                }
            };

            xhr.onerror = function() {
                console.error('Network error');
            };

            xhr.send(formData);
        });
    });
</script>