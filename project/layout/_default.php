<?php
$page = isset($_GET['page']) ? $_GET['page'] : "index";
?>
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
        <?php include 'layout/partials/_header.php' ?>
        <!--begin::Wrapper-->
        <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
            <?php include 'layout/partials/_sidebar.php' ?>
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    <?php
                    if ($page == 'structure') {
                        include 'layout/partials/_structure.php';
                    } else if ($page == 'pos') {
                        include 'layout/partials/_pos.php';
                    } else {
                        include 'layout/partials/_content.php';
                    }
                    ?>
                </div>
                <!--end::Content wrapper-->

            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->
<?php include 'partials/_drawers.php' ?>