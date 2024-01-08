<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <form id="add_animal_form" class="form d-flex flex-column flex-lg-row">
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
                            <div class="custom-drop-zone border-1 border-dashed card-rounded" id="animal_dropzone">
                                <div id="dropzone_message">
                                    <i class="bi bi-upload text-primary" style="font-size: 3rem;"></i>
                                    <div class="ms-4">
                                        <h3 class="fs-5 fw-bold text-gray-900 my-2">აირჩიეთ ან გადმოქაჩეთ სურათი.</h3>
                                        <span class="fs-7 fw-semibold text-gray-400">შესაძლებელია 3 სურათამდე ატვირთვა</span>
                                    </div>
                                </div>
                                <div id="dropzone_content"></div>
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
                                            <textarea name="description" class="form-control" id="query" style="height: 129px;" placeholder="ცხოველის აღწერა, მაგალითად: ბინი, 2 წლის, მამრობითი სქესის, აცრილია, უყვარს ბურთთან თამაში, არის უსაყვარლესი ძაღლი"></textarea>
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
    document.querySelector("#submit_animal_button").addEventListener("click", async function(event) {
        event.preventDefault();

        var formData = new FormData(document.getElementById("add_animal_form"));
        formData.append("owner_id", <?php echo $_SESSION['user_id']; ?>);

        var mainImageInput = document.querySelector('[name="avatar"]');
        if (mainImageInput.files.length > 0) {
            formData.append('file[]', mainImageInput.files[0], 'main_image.png');
            formData.append('is_thumbnail[]', 1);
        }

        var dropzoneContent = document.getElementById('dropzone_content');
        var thumbnailContainers = dropzoneContent.getElementsByClassName('custom-image-thumbnail');

        var fileCreationPromises = [];

        for (let i = 0; i < thumbnailContainers.length; i++) {
            var img = thumbnailContainers[i].querySelector('.custom-image-container');
            if (img) {
                var fileCreationPromise = fetch(img.src)
                    .then(response => response.blob())
                    .then(blob => {
                        return new File([blob], 'image_' + (i + 1) + '.png', {
                            type: 'image/png'
                        });
                    });

                fileCreationPromises.push(fileCreationPromise);
            }
        }

        var files = await Promise.all(fileCreationPromises);

        for (let i = 0; i < files.length; i++) {
            formData.append('file[]', files[i]);
            formData.append('is_thumbnail[]', 0);
        }

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
            var isImageChanged = !imageInput.classList.contains('image-input-empty');

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

        var dropzone = document.getElementById("animal_dropzone");
        var dropzoneMessage = document.getElementById("dropzone_message");
        var dropzoneContent = document.getElementById("dropzone_content");

        function toggleDropzoneMessageVisibility() {
            var hasChildren = dropzoneContent.children.length > 0;
            dropzoneMessage.style.display = hasChildren ? "none" : "block";
        }

        toggleDropzoneMessageVisibility();

        var observer = new MutationObserver(function(mutations) {
            toggleDropzoneMessageVisibility();
        });

        var observerConfig = {
            childList: true
        };

        observer.observe(dropzoneContent, observerConfig);


    });
</script>

<script>
    const dropzone = document.getElementById('animal_dropzone');
    const dropzoneContent = document.getElementById('dropzone_content');
    const message = document.getElementById('dropzone_message');

    dropzone.addEventListener('dragover', handleDragOver);
    dropzone.addEventListener('drop', handleDrop);
    dropzone.addEventListener('click', handleClick);

    function handleDragOver(event) {
        event.preventDefault();
    }

    function handleDrop(event) {
        event.preventDefault();

        const filesToProcess = Array.from(event.dataTransfer.files).slice(0, 3);

        handleFiles(filesToProcess);
    }

    function handleClick(event) {
        const isDeleteButton = event.target.closest('.custom-corner-button');
        if (!isDeleteButton) {
            const fileInput = createFileInput();
            fileInput.addEventListener('change', function(event) {
                const filesToProcess = Array.from(event.target.files).slice(0, 3);
                handleFiles(filesToProcess);
                document.body.removeChild(fileInput);
            });
            fileInput.click();
        }
    }

    function createFileInput() {
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.style.display = 'none';
        fileInput.multiple = true;
        document.body.appendChild(fileInput);
        return fileInput;
    }

    function handleFiles(files) {
        const allowedExtensions = ['.png', '.jpg', '.jpeg'];
        const filteredFiles = Array.from(files).filter(file => {
            const extension = file.name.split('.').pop().toLowerCase();
            return allowedExtensions.includes(`.${extension}`);
        });

        const totalFiles = dropzoneContent.childElementCount + filteredFiles.length;

        if (totalFiles > 3) {
            const filesToRemove = totalFiles - 3;

            for (let i = 0; i < filesToRemove; i++) {
                const oldestFile = dropzoneContent.firstChild;

                if (oldestFile) {
                    dropzoneContent.removeChild(oldestFile);
                }
            }
        }

        for (const file of filteredFiles) {
            const thumbnailContainer = createThumbnailContainer(file);
            dropzoneContent.appendChild(thumbnailContainer);
        }

        message.style.display = dropzoneContent.childElementCount === 0 ? 'block' : 'none';
    }

    function createThumbnailContainer(file) {
        const thumbnailContainer = document.createElement('div');
        thumbnailContainer.classList.add('p-3', 'custom-image-thumbnail');

        const input = document.createElement('input');
        input.type = 'image';
        input.classList.add('custom-image-container');
        input.src = URL.createObjectURL(file);
        input.alt = 'Thumbnail';
        input.style.width = '120px';
        input.style.height = '120px';
        input.style.objectFit = 'cover';
        input.addEventListener('load', function() {
            const deleteButton = document.createElement('i');
            deleteButton.classList.add('btn', 'rounded-circle', 'rounded-circle', 'btn-active-color-primary', 'bg-body', 'p-1', 'bi', 'bi-x', 'fs-2', 'custom-corner-button');
            deleteButton.addEventListener('click', function() {
                dropzoneContent.removeChild(thumbnailContainer);
                message.style.display = dropzoneContent.childElementCount === 0 ? 'block' : 'none';
            });

            thumbnailContainer.appendChild(input);
            thumbnailContainer.appendChild(deleteButton);

            dropzoneContent.appendChild(thumbnailContainer);
        });

        return thumbnailContainer;
    }
</script>