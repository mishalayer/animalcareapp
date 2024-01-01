<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div id="additional_filters" class="collapse fs-6">
            <div class="card pb-3">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">დამატებითი ძებნის პარამეტრები</h3>
                    </div>
                </div>
                <div class="card-body border-top py-9 px-md-9 px-4">
                    <div class="d-flex justify-content-between mb-5 row">
                        <div class="col-6 col-md-4 px-1 mb-3">
                            <div class="input-group">
                                <label class="input-group-text" for=""><i class="bi bi-search fs-1"></i></label>
                                <input class="form-control" placeholder="სახელი..." id="filterAnimalName" />
                            </div>
                        </div>
                        <div class="col-6 col-md-4 px-1 mb-3">
                            <div class="input-group">
                                <label class="input-group-text" for=""><i class="bi bi-sort-numeric-down fs-1"></i></label>
                                <select name="sortingSelection" id="sortingSelectionID" class="form-select">
                                    <option value="DESC" selected>ჯერ ახალი</option>
                                    <option value="ASC">ჯერ ძველი</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 px-1 mb-3">
                            <div class="input-group">
                                <label class="input-group-text" for=""><i class="bi bi-person-heart fs-1"></i></label>
                                <select name="supportSelection" id="supportSelectionID" class="form-select">
                                    <option value="all" selected>ყველა</option>
                                    <option value="without_support">მეურვის გარეშე</option>
                                    <option value="with_support">მეურვის მქონე</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 px-1 mb-3">
                            <div class="input-group">
                                <label class="input-group-text" for=""><i class="bi bi-calendar-event fs-1" style="transform: scaleX(-1);"></i></label>
                                <input class="form-control form-select" placeholder="თარიღიდან..." id="calendar_start_date" />
                            </div>
                        </div>
                        <div class="col-6 col-md-4 px-1 mb-3">
                            <div class="input-group">
                                <label class="input-group-text" for=""><i class="bi bi-calendar-event fs-1"></i></label>
                                <input class="form-control form-select" placeholder="თარიღამდე..." id="calendar_end_date" />
                            </div>
                        </div>
                        <div class="col-6 col-md-4 px-1 mb-3">
                            <div class="input-group">
                                <label class="input-group-text" for=""><i class="bi bi-trash-fill fs-1"></i></label>
                                <div class="form-control btn btn-sm fw-bold bg-secondary btn-color-gray-700 btn-active-color-primary custom-click-filter clear-filter-button p-4" id="clearFilters">გასუფთავება</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3 m-5 justify-content-end">
            <div id="additional_filters_button" class="btn btn-sm fw-bold bg-body btn-color-gray-700 btn-active-color-primary custom-click-filter collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#additional_filters"><i class="bi bi-sliders"></i>დამატებითი ფილტრაცია</div>
            <a href="?page=add_element" class="btn btn-sm fw-bold btn-primary"><i class="bi bi-plus-lg"></i>ცხოველის დამატება</a>
        </div>
        <div class="d-flex flex-column flex-xl-row">
            <div class="d-flex flex-row-fluid me-xl-9 mb-10 mb-xl-0">
                <div class="card card-flush card-p-0 bg-transparent border-0 w-100">
                    <div class="card-body">
                        <ul class="nav nav-pills d-flex justify-content-between nav-pills-custom gap-3 mb-6 mx-10 px-8">
                            <li class="nav-item mb-3 me-0 custom-category-card custom-click-filter category-all">
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack py-7 page-bg show active" data-bs-toggle="pill" href="#category_all" style="width: 138px;height: 180px">
                                    <div class="nav-icon">
                                        <img src="images/custom_images/AllAnimals.png" class="w-80px" alt="" />
                                    </div>
                                    <div class="">
                                        <span class="fw-bold fs-2 d-block text-black">საერთო</span>
                                        <span id="totalCount" class="fw-semibold fs-7 text-black"></span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item mb-3 me-0 custom-category-card custom-click-filter category-dogs">
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack py-7 page-bg" data-bs-toggle="pill" href="#category_dog" style="width: 138px;height: 180px">
                                    <div class="nav-icon">
                                        <img src="images/custom_images/Dogs.png" class="w-80px" alt="" />
                                    </div>
                                    <div class="">
                                        <span class="fw-bold fs-2 d-block text-black">ძაღლები</span>
                                        <span id="dogCount" class="fw-semibold fs-7 text-black"></span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item mb-3 me-0 custom-category-card custom-click-filter category-cats">
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack py-7 page-bg" data-bs-toggle="pill" href="#category_cat" style="width: 138px;height: 180px">
                                    <div class="nav-icon">
                                        <img src="images/custom_images/Cats.png" class="w-80px" alt="" />
                                    </div>
                                    <div class="">
                                        <span class="fw-bold fs-2 d-block text-black">კატები</span>
                                        <span id="catCount" class="fw-semibold fs-7 text-black"></span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item mb-3 me-0 custom-category-card custom-click-filter category-parrots">
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack py-7 page-bg" data-bs-toggle="pill" href="#category_parrot" style="width: 138px;height: 180px">
                                    <div class="nav-icon">
                                        <img src="images/custom_images/Parrots.png" class="w-80px" alt="" />
                                    </div>
                                    <div class="">
                                        <span class="fw-bold fs-2 d-block text-black">თუთიყუშები</span>
                                        <span id="parrotCount" class="fw-semibold fs-7 text-black"></span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item mb-3 me-0 custom-category-card custom-click-filter category-other">
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack py-7 page-bg" data-bs-toggle="pill" href="#category_other" style="width: 138px;height: 180px">
                                    <div class="nav-icon">
                                        <img src="images/custom_images/OtherAnimals.png" class="w-80px" alt="" />
                                    </div>
                                    <div class="">
                                        <span class="fw-bold fs-2 d-block text-black">სხვა</span>
                                        <span id="otherCount" class="fw-semibold fs-7 text-black"></span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="d-flex flex-wrap d-grid gap-5 gap-xxl-9" id="animalContent">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var nameSelection = document.getElementById("filterAnimalName");
            var sortingSelection = document.getElementById("sortingSelectionID");
            var supportSelection = document.getElementById("supportSelectionID");
            var dateSelectionStart = document.getElementById("calendar_start_date");
            var dateSelectionEnd = document.getElementById("calendar_end_date");

            function loadCategoryContent() {
                var support = supportSelection.value;
                var sorting = sortingSelection.value;
                var name = nameSelection.value;
                var start_date = dateSelectionStart.value;
                var end_date = dateSelectionEnd.value;
                var category = document.querySelector(".custom-click-filter a.active").getAttribute("href").replace("#category_", "");
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "load_category.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);

                        document.getElementById("animalContent").innerHTML = response.content;

                        document.getElementById("totalCount").innerText = response.counts.total + " შედეგი";
                        document.getElementById("dogCount").innerText = response.counts.dog + " ძაღლი";
                        document.getElementById("catCount").innerText = response.counts.cat + " კატა";
                        document.getElementById("parrotCount").innerText = response.counts.parrot + " თუთიყუში";
                        document.getElementById("otherCount").innerText = response.counts.other + " შედეგი";
                    }
                };

                var requestData = "category=" + category + "&sorting=" + sorting + "&support=" + support + "&name=" + name + "&start_date=" + start_date + "&end_date=" + end_date;

                xhr.send(requestData);
            }

            loadCategoryContent();

            function clearFilters() {
                document.getElementById("filterAnimalName").value = "";
                document.getElementById("sortingSelectionID").value = "DESC";
                document.getElementById("supportSelectionID").value = "all";
                document.getElementById("calendar_start_date").value = "";
                document.getElementById("calendar_end_date").value = "";

                loadCategoryContent();
            }

            document.getElementById("clearFilters").addEventListener("click", clearFilters);

            var categoryLinks = document.querySelectorAll(".custom-click-filter a");
            categoryLinks.forEach(function(link) {
                link.addEventListener("click", function(e) {
                    e.preventDefault();

                    loadCategoryContent();
                });
            });
            sortingSelection.addEventListener("change", function() {
                loadCategoryContent();
            });
            supportSelection.addEventListener("change", function() {
                loadCategoryContent();
            });
            var timeout;
            document.getElementById("filterAnimalName").addEventListener("keyup", function() {
                clearTimeout(timeout);
                timeout = setTimeout(loadCategoryContent, 500);
            });
            flatpickr("#calendar_start_date", {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    loadCategoryContent();
                }
            });
            flatpickr("#calendar_end_date", {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    loadCategoryContent();
                }
            });
        });
    </script>