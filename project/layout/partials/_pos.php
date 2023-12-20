<?php
include "database.php";
$query = "SELECT
    COUNT(*) AS total,
    SUM(CASE WHEN animal_type = 'dog' THEN 1 ELSE 0 END) AS dog_count,
    SUM(CASE WHEN animal_type = 'cat' THEN 1 ELSE 0 END) AS cat_count,
    SUM(CASE WHEN animal_type = 'parrot' THEN 1 ELSE 0 END) AS parrot_count,
    SUM(CASE WHEN animal_type = 'other' THEN 1 ELSE 0 END) AS other_count
FROM animaltable;";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

$allCategoryCount = $row['total'];
$dogCategoryCount = $row['dog_count'];
$catCategoryCount = $row['cat_count'];
$parrotCategoryCount = $row['parrot_count'];
$otherCategoryCount = $row['other_count'];
?>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="d-flex align-items-center gap-2 gap-lg-3 m-5 justify-content-end">
            <!-- <a href="../../demo1/dist/apps/ecommerce/sales/listing.html" class="btn btn-sm fw-bold bg-body btn-color-gray-700 btn-active-color-primary"><i class="bi bi-sliders"></i>დამატებითი ფილტრაცია</a> -->
            <a href="?page=add_element" class="btn btn-sm fw-bold btn-primary">ცხოველის დამატება</a>
        </div>
        <div class="d-flex flex-column flex-xl-row">
            <div class="d-flex flex-row-fluid me-xl-9 mb-10 mb-xl-0">
                <div class="card card-flush card-p-0 bg-transparent border-0 w-100">
                    <div class="card-body">
                        <ul class="nav nav-pills d-flex justify-content-between nav-pills-custom gap-3 mb-6 mx-10 px-8">
                            <li class="nav-item mb-3 me-0 custom-category-card category-all">
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack py-7 page-bg show active" data-bs-toggle="pill" href="#category_all" style="width: 138px;height: 180px">
                                    <div class="nav-icon">
                                        <img src="images/custom_images/AllAnimals.png" class="w-80px" alt="" />
                                    </div>
                                    <div class="">
                                        <span class="fw-bold fs-2 d-block text-black">საერთო</span>
                                        <span class="fw-semibold fs-7 text-black"><?php echo $allCategoryCount ?> შედეგი</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item mb-3 me-0 custom-category-card category-dogs">
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack py-7 page-bg" data-bs-toggle="pill" href="#category_dog" style="width: 138px;height: 180px">
                                    <div class="nav-icon">
                                        <img src="images/custom_images/Dogs.png" class="w-80px" alt="" />
                                    </div>
                                    <div class="">
                                        <span class="fw-bold fs-2 d-block text-black">ძაღლები</span>
                                        <span class="fw-semibold fs-7 text-black"><?php echo $dogCategoryCount ?> ძაღლი</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item mb-3 me-0 custom-category-card category-cats">
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack py-7 page-bg" data-bs-toggle="pill" href="#category_cat" style="width: 138px;height: 180px">
                                    <div class="nav-icon">
                                        <img src="images/custom_images/Cats.png" class="w-80px" alt="" />
                                    </div>
                                    <div class="">
                                        <span class="fw-bold fs-2 d-block text-black">კატები</span>
                                        <span class="fw-semibold fs-7 text-black"><?php echo $catCategoryCount ?> კატა</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item mb-3 me-0 custom-category-card category-parrots">
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack py-7 page-bg" data-bs-toggle="pill" href="#category_parrot" style="width: 138px;height: 180px">
                                    <div class="nav-icon">
                                        <img src="images/custom_images/Parrots.png" class="w-80px" alt="" />
                                    </div>
                                    <div class="">
                                        <span class="fw-bold fs-2 d-block text-black">თუთიყუშები</span>
                                        <span class="fw-semibold fs-7 text-black"><?php echo $parrotCategoryCount ?> თუთიყუში</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item mb-3 me-0 custom-category-card category-other">
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack py-7 page-bg" data-bs-toggle="pill" href="#category_other" style="width: 138px;height: 180px">
                                    <div class="nav-icon">
                                        <img src="images/custom_images/OtherAnimals.png" class="w-80px" alt="" />
                                    </div>
                                    <div class="">
                                        <span class="fw-bold fs-2 d-block text-black">Other</span>
                                        <span class="fw-semibold fs-7 text-black"><?php echo $otherCategoryCount ?> შედეგი</span>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function loadCategoryContent(category) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "load_category.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById("animalContent").innerHTML = xhr.responseText;
                    }
                };

                xhr.send("category=" + category);
            }

            loadCategoryContent('all');

            var categoryLinks = document.querySelectorAll(".custom-category-card a");
            categoryLinks.forEach(function(link) {
                link.addEventListener("click", function(e) {
                    e.preventDefault();

                    var category = this.getAttribute("href").replace("#category_", "");

                    loadCategoryContent(category);
                });
            });
        });
    </script>