<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row">
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <div class="card card-flush pb-4 pt-1">
                    <a href="?page=index">
                        <button class="btn btn-light p-4 custom-return-button btn-square">
                            <i class="bi bi-arrow-return-left fs-1"></i>
                        </button>
                    </a>
                    <div class="card-header">
                        <div class="card-title ps-20">
                            <h2>მთავარი სურათი</h2>
                        </div>
                    </div>
                    <div class="card-body text-center pt-0">
                        <style>
                            .image-input-placeholder {
                                background-image: url('assets/media/svg/files/blank-image.svg');
                            }

                            [data-bs-theme="dark"] .image-input-placeholder {
                                background-image: url('assets/media/svg/files/blank-image-dark.svg');
                            }
                        </style>
                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                            <div class="image-input-wrapper w-150px h-150px custom-image-wrapper"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="avatar_remove" />
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        <div class="text-muted fs-7">აირჩიეთ მთავარი სურათი. მიიღება *.png, *.jpg ან *.jpeg გაფართოების ფაილი</div>
                    </div>
                </div>
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Media</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="fv-row mb-2">
                            <div class="dropzone" id="animal_dropzone">
                                <div class="dz-message needsclick">
                                    <i class="bi bi-upload text-primary" style="font-size: 3rem;"></i>
                                    <div class="ms-4">
                                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">აირჩიეთ ან გადმოქაჩეთ სურათი.</h3>
                                        <span class="fs-7 fw-semibold text-gray-400">შესაძლებელია 3 სურათამდე ატვირთვა</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-muted fs-7">ატვირთეთ სურათები გალერეაში</div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>ინფორმაცია</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="mb-8 fv-row">
                                        <label class="required form-label">ცხოველის სახელი</label>
                                        <input type="text" name="name" class="form-control mb-2" placeholder="ცხოველის სახელი, მაგალითად: ბინი, მაქსი, სინდი" value="" />
                                        <div class="text-muted fs-7">ცხოველის სახელი სავალდებულოა.</div>
                                    </div>

                                    <div class="mb-8 fv-row">
                                        <label class="required form-label">საკონტაქტო ინფორმაცია</label>
                                        <input type="text" name="contact_info" class="form-control mb-2" placeholder="საკონტაქტო ინფორმაცია, მაგალითად: ტელეფონი, ადგილმდებარეობა" value="" />
                                        <div class="text-muted fs-7">საკონტაქტო ინფორმაცია სავალდებულოა.</div>
                                    </div>
                                    <div class="mb-8 fv-row">
                                        <label class="required form-label">ცხოველის სახეობა</label>
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" name="animal_type" id="add_element_animal_type">
                                            <option></option>
                                            <option value="other" selected="selected">სხვა</option>
                                            <option value="dog">ძაღლი</option>
                                            <option value="cat">კატა</option>
                                            <option value="parrot">თუთიყუში</option>
                                        </select>
                                        <div class="text-muted fs-7">აირჩიეთ ცხოველის ტიპი.</div>
                                    </div>
                                    <div>
                                        <label class="form-label">ცხოველის აღწერა</label>
                                        <div class="mb-2">
                                            <textarea name="description" class="form-control" id="query" style="height: 111px;" placeholder="ცხოველის აღწერა, მაგალითად: ბინი, 2 წლის, მამრობითი სქესის, აცრილია, უყვარს ბურთთან თამაში, არის უსაყვარლესი ძაღლი"></textarea>
                                        </div>
                                        <div class="text-muted fs-7">მიუთითეთ ნებისმიერი ინფორმაცია ცხოველის შესახებ.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="?page=pos" class="btn btn-light me-5">გაუქმება</a>
                    <button type="submit" id="submit_animal_button" class="btn btn-primary">
                        <span class="indicator-label">განთავსება</span>
                        <span class="indicator-progress">გთხოვთ დაელოდოთ...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<script>
    document.querySelector("#submit_animal_button").addEventListener("click", function(event) {
        event.preventDefault();

        var formData = new FormData(document.getElementById("kt_ecommerce_add_product_form"));

        formData.append("owner_id", <?php echo $_SESSION['user_id']; ?>);

        var mainImageInput = document.querySelector('[name="avatar"]');

        if (mainImageInput.files.length > 0) {
            formData.append('file[]', mainImageInput.files[0]);
            formData.append('is_thumbnail[]', 1);
        }

        myDropzone.files.forEach(function(file) {
            formData.append('file[]', file);
            formData.append('is_thumbnail[]', 0);
        });

        fetch('submit_animal.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                window.location.href = '?page=index';
            })
            .catch(error => {
                console.error("Error submitting form:", error);
            });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var nameInput = document.querySelector('[name="name"]');
        var informationInput = document.querySelector('[name="contact_info"]');
        var imageInput = document.querySelector('.image-input');
        var submitButton = document.querySelector('#submit_animal_button');

        function checkRequiredFields() {
            var nameFilled = nameInput.value.trim() !== '';
            var informationFilled = informationInput.value.trim() !== '';
            var isImageChanged = imageInput.classList.contains('image-input-changed');

            submitButton.disabled = !(nameFilled && informationFilled && isImageChanged);
        }

        nameInput.addEventListener("input", checkRequiredFields);
        informationInput.addEventListener("input", checkRequiredFields);

        var observer = new MutationObserver(checkRequiredFields);
        observer.observe(imageInput, {
            attributes: true,
            attributeFilter: ['class']
        });

        checkRequiredFields();
    });
</script>
<script>
    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone("#animal_dropzone", {
        url: "upload_animal_images.php",
        maxFiles: 3,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        autoProcessQueue: false,
    });

    myDropzone.on("addedfile", function(file) {
        if (myDropzone.files.length > myDropzone.options.maxFiles) {
            var removedFile = myDropzone.files[0];
            myDropzone.removeFile(removedFile);
        }
    });
</script>