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
                    <span class="card-label fw-bold fs-3 mb-1">თქვენი მეურვეობის ქვეშ მყოფი ცხოველები</span>
                    <span id="totalCount" class="text-muted mt-1 fw-semibold fs-7"></span>
                </h3>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th class="min-w-200px">ცხოველი</th>
                                <th class="min-w-150px">განთავსების თარიღი</th>
                                <th class="min-w-150px">მეურვეობის აღების თარიღი</th>
                                <th class="min-w-150px">სახეობა</th>
                                <th class="min-w-50px text-end">მეურვეობის გაუქმება</th>
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
<div class="modal fade" tabindex="-1" id="confirm_cancellation_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-5">
                <h3 class="modal-title">მეურვეობის შეწყვეტა</h3>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x fs-1"></i>
                </button>
            </div>
            <div class="modal-body py-3">
                <div class="d-flex justify-content-center">
                    <img id="bodyImage" class="my-2" src="" style="height: 200px; width: 200px; object-fit: cover; border-radius: 0.475rem;">
                </div>
                <div class="d-flex justify-content-center my-3 fw-bold text-gray-600 fs-3"><span class="text-center">დარწმუნებული ხართ რომ გსურთ <span id="bodyText"></span>ს მეურვეობის შეწყვეტა?</span></div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button id="confirmCancelButton" value="" type="button" class="btn btn-danger fw-bold"><i class="bi bi-dash-circle fs-2"></i> შეწყვეტა</button>
                <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">გაუქმება</button>
            </div>
        </div>
    </div>
</div>

<script>
    function cancel_patronage(animalId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "cancel_patronage.php", true);
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
            xhr.open("POST", "load_support_list.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById("myListTable").innerHTML = response.content;
                    document.getElementById("totalCount").innerText = response.animalCount + " შედეგი";
                }
            };

            xhr.send();
        }

        loadCategoryContent();
    });

    var cancellationModal = document.getElementById('confirm_cancellation_modal')
    cancellationModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;

        var id = button.getAttribute('data-bs-id');
        var data = button.getAttribute('data-bs-data');
        var image = button.getAttribute('data-bs-image');

        var bodyImage = document.getElementById("bodyImage");
        var bodyText = document.getElementById("bodyText");
        var confirmCancelButton = document.getElementById("confirmCancelButton");

        bodyImage.setAttribute("src", image);
        bodyText.innerHTML = data;
        confirmCancelButton.value = id;
    })

    var confirmCancelButton = document.getElementById("confirmCancelButton");
    confirmCancelButton.addEventListener('click', function() {
        animalId = confirmCancelButton.value;
        cancel_patronage(animalId);
    });
</script>