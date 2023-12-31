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
                            <?php echo $_SESSION['username'] ?></div> <span class="badge badge-light-success fw-bold fs-8 px-2 py-1">
                            <div><?php if ($_SESSION['privilege'] == 2) {
                                        echo "ადმინისტრატორი";
                                    } else {
                                        echo "მომხმარებელი";
                                    } ?></div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="separator my-2"></div>
    <?php
    if ($_SESSION['privilege'] == 2) {
        echo "<div class='menu-item px-5'>
        <a href='?page=logs' class='menu-link px-5'>
        <i class='bi bi-table me-5 fs-1'></i>
            ლოგები
        </a>
    </div>";
    }
    ?>
    <div class="menu-item px-5">
        <a href="?page=my_list" class="menu-link px-5">
            <i class="bi bi-file-richtext-fill me-5 fs-1"></i>
            ჩემი განცხადებები
        </a>
    </div>
    <div class="menu-item px-5">
        <a href="?page=support_list" class="menu-link px-5">
            <i class="bi bi-coin me-5 fs-1"></i>
            მეურვეობა
        </a>
    </div>
    <div class="menu-item px-5">
        <a href="?page=account_settings" class="menu-link px-5">
            <i class="bi bi-gear-fill me-5 fs-1"></i>
            პარამეტრები
        </a>
    </div>
    <div class="menu-item px-5">
        <a href="log_out.php" class="menu-link px-5">
            <i class="bi bi-box-arrow-left me-5 fs-1"></i>
            გამოსვლა
        </a>
    </div>
</div>