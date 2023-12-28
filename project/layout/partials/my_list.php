<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column ms-20">
                    <a href="?page=index">
                        <button class="btn btn-light p-4 custom-return-button btn-square">
                            <i class="bi bi-arrow-return-left fs-1"></i>
                        </button>
                    </a>
                    <span class="card-label fw-bold fs-3 mb-1">ჩემი განცხადებები</span>
                    <span id="totalCount" class="text-muted mt-1 fw-semibold fs-7"></span>
                </h3>
                <div>
                    <a href="?page=add_element" class="btn btn-sm fw-bold btn-primary my-3"><i class="bi bi-plus-lg"></i>ცხოველის დამატება</a>
                </div>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th class="min-w-200px">ცხოველი</th>
                                <th class="min-w-150px">განთავსების თარიღი</th>
                                <th class="min-w-150px">სახეობა</th>
                                <th class="min-w-100px text-end">ქმედება</th>
                            </tr>
                        </thead>
                        <tbody id="myListTable">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="delete_element_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-5">
                <h3 class="modal-title">განცხადების წაშლა</h3>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x fs-1"></i>
                </button>
            </div>
            <div class="modal-body py-3">
                <div class="d-flex justify-content-center">
                    <img id="bodyImage" class="my-2" src="" style="height: 200px; width: 200px; object-fit: cover; border-radius: 0.475rem;">
                </div>
                <div class="d-flex justify-content-center my-3 fw-bold text-gray-600 fs-3"><span class="text-center">დარწმუნებული ხართ რომ გსურთ <span id="bodyText"></span>ს განცხადების წაშლა?</span></div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button id="confirmDeleteButton" value="" type="button" class="btn btn-danger fw-bold"><i class="bi bi-trash-fill fs-2"></i> წაშლა</button>
                <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">გაუქმება</button>
            </div>
        </div>
    </div>
</div>
<script>
    function delete_element(animalId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_element.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                location.reload();
            }
        };

        var requestData = "animalId=" + animalId;

        xhr.send(requestData);
    }

    document.addEventListener("DOMContentLoaded", function() {
        function loadCategoryContent() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "load_my_list.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById("myListTable").innerHTML = response.content;
                    document.getElementById("totalCount").innerText = response.animalCount + " განცხადება";
                }
            };

            xhr.send();
        }

        loadCategoryContent();
    });

    var deletionModal = document.getElementById('delete_element_modal')
    deletionModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;

        var id = button.getAttribute('data-bs-id');
        var data = button.getAttribute('data-bs-data');
        var image = button.getAttribute('data-bs-image');

        var bodyImage = document.getElementById("bodyImage");
        var bodyText = document.getElementById("bodyText");
        var confirmDeleteButton = document.getElementById("confirmDeleteButton");

        bodyImage.setAttribute("src", image);
        bodyText.innerHTML = data;
        confirmDeleteButton.value = id;
    })

    var confirmDeleteButton = document.getElementById("confirmDeleteButton");
    confirmDeleteButton.addEventListener('click', function() {
        animalId = confirmDeleteButton.value;
        delete_element(animalId);
    });
</script>