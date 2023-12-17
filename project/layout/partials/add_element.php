<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/products.html">
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Main image</h2>
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
                            <div class="image-input-wrapper w-150px h-150px"></div>
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
                        <div class="text-muted fs-7">Set the animal's main image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
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
                                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                        <span class="fs-7 fw-semibold text-gray-400">Upload up to 3 files</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-muted fs-7">Set the product media gallery.</div>
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
                                        <h2>General</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="mb-8 fv-row">
                                        <label class="required form-label">Animal's Name</label>
                                        <input type="text" name="product_name" class="form-control mb-2" placeholder="Animal's name" value="" />
                                        <div class="text-muted fs-7">The animals name is required.</div>
                                    </div>

                                    <div class="mb-8 fv-row">
                                        <label class="required form-label">Location</label>
                                        <input type="text" name="product_name" class="form-control mb-2" placeholder="Location" value="" />
                                        <div class="text-muted fs-7">The location is required.</div>
                                    </div>
                                    <div>
                                        <label class="form-label">Description</label>
                                        <div class="mb-2">
                                            <textarea class="form-control" id="query" style="height: 186px;" placeholder="Add a description"></textarea>
                                        </div>
                                        <div class="text-muted fs-7">Set a description to the product for better visibility.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="?page=pos" class="btn btn-light me-5">Cancel</a>
                    <button type="submit" id="submit_animal_button" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
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
    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone("#animal_dropzone", {
        url: "your-upload-endpoint",
        maxFiles: 3,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        autoProcessQueue: false,
    });

    myDropzone.on("addedfile", function(file) {
        console.log("File added:", file);

        if (myDropzone.files.length > myDropzone.options.maxFiles) {
            var oldestFile = myDropzone.files[0];
            myDropzone.removeFile(oldestFile);

            console.log("Removed oldest file:", oldestFile);
        }
    });

    myDropzone.on("removedfile", function(file) {
        console.log("File removed:", file);
    });

    myDropzone.on("click", function() {
        document.querySelector("#animal_dropzone input[type=file]").click();
    });

    document.querySelector("#your-submit-button").addEventListener("click", function() {
        myDropzone.processQueue();
    });
</script>