<?php
$page = isset($_GET['page']) ? $_GET['page'] : "index";
?>
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
        <?php include 'layout/partials/_header.php' ?>
        <div id="kt_app_wrapper">
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">
                    <?php
                    if ($page == 'pos') {
                        include 'layout/partials/_pos.php';
                    } else if ($page == 'add_element') {
                        include 'layout/partials/add_element.php';
                    } else if ($page == 'account_settings') {
                        include 'layout/partials/account_settings.php';
                    } else if ($page == 'about_animal') {
                        include 'layout/partials/about_animal.php';
                    } else {
                        include 'layout/partials/_pos.php';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>