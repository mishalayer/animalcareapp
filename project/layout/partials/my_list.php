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
<script>
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
</script>