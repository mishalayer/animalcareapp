<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            <div class="d-flex flex-column">
                <div class="fw-bold d-flex align-items-center fs-5">
                    <div class="symbol symbol-50px me-5">
                        <img alt="Logo" <?php echo ($_SESSION['picture_path'] === 'NULL') ? 'src="images/person_images/defaultprofile.png"' : 'src="' . $_SESSION['picture_path'] . '")'; ?> />
                    </div>
                    <div>
                        <div>
                            <?php echo $_SESSION['username'] ?></div> <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                            <div><?php if ($_SESSION['privilege'] == 2) {
                                        echo "ადმინისტრატორი";
                                    } else {
                                        echo "მომხმარებელი";
                                    } ?></div>
                        </span>
                    </div>
                </div>
                <a class="fw-semibold text-muted text-hover-primary fs-7">
                    დაშვების დონე: <?php echo $_SESSION['privilege'] ?></a>
            </div>
        </div>
    </div>
    <div class="separator my-2"></div>
    <div class="menu-item px-5">
        <a href="?page=account_settings" class="menu-link px-5">
            პარამეტრები
        </a>
    </div>
    <div class="menu-item px-5">
        <a href="log_out.php" class="menu-link px-5">
            გამოსვლა
        </a>
    </div>
</div>