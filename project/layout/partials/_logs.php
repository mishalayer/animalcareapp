<?php
include("database.php");
?>
<header>
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
</header>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="d-flex flex-column flex-xl-row">
            <div class="d-flex flex-row-fluid me-xl-9 mb-10 mb-xl-0">
                <div class="card card-flush card-p-0 px-md-12 pb-md-12 border-0 w-100">
                <div class="card-header border-0">
                <a href="?page=index">
                    <button class="btn btn-light p-4 custom-return-button btn-square">
                        <i class="bi bi-arrow-return-left fs-1"></i>
                    </button>
                </a>
                <div class="card-title ps-20 pe-5 m-0 d-flex justify-content-between w-100">
                    <h3 class="fw-bold m-0">ლოგები</h3>
                    <input type="text" id="globalSearch" placeholder="ლოგების ძიება..." class="form-control customFilters customLogSearchFilter">
                </div>
            </div>
                <div class="mid-section-log">
    <div class="logtable table-responsive">
        <table id="logTable" class="stripe table table-striped gy-4 gs-1 col-12">
            <thead>
                <tr>
                    <th class='logTableResponsive'>ლოგის ID</th>
                    <th>object</th>
                    <th>ქმედება</th>
                    <th>თარიღი</th>
                    <th>ინიციატორი</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT logid, object, action, date, initiator FROM logs ORDER BY date DESC";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td class='logTableResponsive'>{$row['logid']}</td>";
                    echo "<td>{$row['object']}</td>";
                    echo "<td>{$row['action']}</td>";
                    echo "<td>{$row['date']}</td>";
                    echo "<td>{$row['initiator']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script>
    $(document).ready(function () {
        // Initialize DataTable with global search enabled
        var table = $('#logTable').DataTable({ 
            "order": [[3, "desc"]],
            "searching": true // Enable global search
        });

        // Bind the input event to the custom search input field
        $('#globalSearch').on('input', function() {
            table.search(this.value).draw();
        });
    });
</script>
