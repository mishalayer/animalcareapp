<?php
$page = isset($_GET['page']) ? $_GET['page'] : "index";
?>
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
        <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion"><span class="menu-link"><span class="menu-icon"><i class="ki-duotone ki-element-11 fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i></span><span class="menu-title">Home</span><span class="menu-arrow"></span></span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item"><a class="menu-link <?php if ($page === 'index') {
                                                                        echo 'active';
                                                                    } ?>" href="?page=index"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">Datatable</span></a></div>
                        <?php if ($_SESSION['privilege'] == "2") {
                            echo "<div class='menu-item'><a class='menu-link ";
                            if ($page === 'structure') {
                                echo 'active';
                            }
                            echo "' href='?page=structure'><span class='menu-bullet'><span class='bullet bullet-dot'></span></span><span class='menu-title'>Structure</span></a></div>";
                        } ?>
                        <div class="menu-item"><a class="menu-link <?php if ($page === 'pos' or  $page === 'add_element') {
                                                                        echo 'active';
                                                                    } ?>" href="?page=pos"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">Main</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>