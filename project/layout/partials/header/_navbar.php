<div class="app-navbar flex-shrink-0">
    <div class="app-navbar-item ms-1 ms-md-4">
        <?php include 'partials/theme-mode/_main.php' ?>
    </div>
    <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
        <div class="d-flex justify-content-center align-items-center btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <i class="bi bi-person-circle" style="font-size: 20px;"></i>
        </div>
        <?php include 'partials/menus/_user-account-menu.php' ?>
    </div>
</div>