<?php
?>
<header>
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--<link rel="stylesheet" type="text/css" href="./style.css">-->
</header>
<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  container-fluid ">
        <div class="card">
            <div class="card-body">
                <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                    <div id="filterContainer" class="d-flex justify-content-between">
                        <select name="groupSelection" id="groupSelectionID" class="form-select mb-2 customFilters">
                            <option value="0">საერთო</option>
                        </select>
                        <select name="subGroupSelection" id="subGroupSelectionID" class="form-select mb-2 customFilters">
                            <option value="0">საერთო</option>
                        </select>
                        <input type="text" id="globalSearch" placeholder="საერთო ძიება..." class="form-control customFilters">
                    </div>
                    <div id="mainTableContent">
                        <div class="d-flex justify-content-between">
                            <?php if ($_SESSION['privilege'] == "2") {
                                echo '<button id="addButton" class="btn fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#add_person_modal">
                                პიროვნების დამატება
                            </button>';
                            } else {
                                echo "<div></div>";
                            }
                            ?>
                            <div class="print">
                                <a href="print.php" class="btn fw-bold btn-primary" target="_blank">ბეჭდვა</a>
                                <button id="filterButton" class="btn fw-bold btn-secondary custom-filters filter-btn py-0 px-4"><i class="bi bi-sliders p-0 fs-1 m-0"></i></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTable1" class="table table-striped gy-4 gs-1 col-12">
                                <thead>
                                    <tr>
                                        <th>ოთახი</th>
                                        <th>სახელი</th>
                                        <th>გვარი</th>
                                        <th>ტელეფონი</th>
                                        <th>მობილური</th>
                                        <th>ჯგუფი</th>
                                        <?php if ($_SESSION['privilege'] == "2") {
                                            echo "<th></th>";
                                        };
                                        ?>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="p-1">ოთახი</th>
                                        <th class="p-1">სახელი</th>
                                        <th class="p-1">გვარი</th>
                                        <th class="p-1">ტელეფონი</th>
                                        <th class="p-1">მობილური</th>
                                        <th class="p-1">ჯგუფი</th>
                                        <?php if ($_SESSION['privilege'] == "2") {
                                            echo "<th></th>";
                                        };
                                        ?>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                            <!--end::Row-->
                        </div>
                    </div>
                </div>
                <!--end::Content container-->
            </div>
        </div>
        <!-- ---------------------------------Modal sector here---------------------------------------- -->
        <div class="modal fade" tabindex="-1" id="add_person_modal">
            <div class="modal-dialog modal-dialog-centered mw-900px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">მომხმარებლის დამატება</h3>

                        <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <label class="fw-bold form-label">ოთახი</label>
                        <input type="text" class="form-control" name="room" placeholder="მაგალითად: 128" />
                        <label class="fw-bold form-label">სახელი</label>
                        <input type="text" class="form-control" name="name" placeholder="მაგალითად: მიხეილ" />
                        <label class="fw-bold form-label">გვარი</label>
                        <input type="text" class="form-control" name="surname" placeholder="მაგალითად: გიგიაძე" />
                        <label class="fw-bold form-label">ტელეფონი</label>
                        <input type="text" class="form-control" name="tel" placeholder="მაგალითად: 26-12" />
                        <label class="fw-bold form-label">მობილური</label>
                        <input type="text" class="form-control" name="mobile" placeholder="მაგალითად: 555667788" />
                        <label class="fw-bold form-label">ჯგუფი</label>
                        <select name="groupSelection2" id="groupSelectionModalID" class="form-select mb-2">
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">გაუქმება</button>
                        <button id="confirmAddButton" type="button" class="btn btn-primary">დამატება</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="edit_person_modal">
            <div class="modal-dialog modal-dialog-centered mw-900px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">მომხმარებლის რედაქტირება</h3>

                        <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <input id="userID" style="display: none;" disabled name="userID">
                        <label class="fw-bold form-label">ოთახი</label>
                        <input type="text" class="form-control" name="room" placeholder="მაგალითად: 128" />
                        <label class="fw-bold form-label">სახელი</label>
                        <input type="text" class="form-control" name="name" placeholder="მაგალითად: მიხეილ" />
                        <label class="fw-bold form-label">გვარი</label>
                        <input type="text" class="form-control" name="surname" placeholder="მაგალითად: გიგიაძე" />
                        <label class="fw-bold form-label">ტელეფონი</label>
                        <input type="text" class="form-control" name="tel" placeholder="მაგალითად: 26-12" />
                        <label class="fw-bold form-label">მობილური</label>
                        <input type="text" class="form-control" name="mobile" placeholder="მაგალითად: 555667788" />
                        <label class="fw-bold form-label">ჯგუფი</label>
                        <select name="groupSelection2" id="groupSelectionModalID2" class="form-select mb-2">
                        </select>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button id="deleteButton" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm_deletion_modal">წაშლა</button>
                        <div>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">გაუქმება</button>
                            <button id="confirmEditButton" type="button" class="btn btn-primary">რედაქტირება</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="modal fade" tabindex="-2" id="confirm_deletion_modal">
        <div class="modal-dialog modal-dialog-centered mw-400px">
            <div class="modal-content">
                <div class="modal-body"></div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type=" button" class="btn btn-light" data-bs-dismiss="modal">გაუქმება</button>
                    <button id="confirmDeleteButton" type="button" class="btn btn-danger">დადასტურება</button>
                </div>
            </div>
        </div>
    </div> -->
        <!--end::Content-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js">
        </script>
        <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.1.4/js/dataTables.rowGroup.min.js"></script>
        <script>
            function refreshPage() {
                location.reload();
            }

            document.addEventListener("DOMContentLoaded", function() {
                var filterButton = document.getElementById('filterButton');
                var filterContainer = document.getElementById('filterContainer');

                filterButton.addEventListener('click', function() {
                    filterContainer.classList.toggle('hide-filters');
                });
                var addButton = document.getElementById('confirmAddButton');
                if (addButton) {
                    addButton.addEventListener('click', function() {
                        var room = document.querySelector('#add_person_modal input[name="room"]').value;
                        var name = document.querySelector('#add_person_modal input[name="name"]').value;
                        var surname = document.querySelector('#add_person_modal input[name="surname"]').value;
                        var tel = document.querySelector('#add_person_modal input[name="tel"]').value;
                        var mobile = document.querySelector('#add_person_modal input[name="mobile"]').value;
                        var group_id = document.querySelector('#groupSelectionModalID').value;

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4) {
                                if (xhr.status === 200) {
                                    var response = JSON.parse(xhr.responseText);
                                    refreshPage();
                                } else {
                                    console.error('Error inserting data:', xhr.statusText);
                                }
                            }
                        };

                        xhr.open('POST', 'insert_processing.php', true);
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.send(
                            'room=' + encodeURIComponent(room) +
                            '&name=' + encodeURIComponent(name) +
                            '&surname=' + encodeURIComponent(surname) +
                            '&tel=' + encodeURIComponent(tel) +
                            '&mobile=' + encodeURIComponent(mobile) +
                            '&group_id=' + encodeURIComponent(group_id)
                        );
                    });
                }

                var groupSelect = document.getElementById('groupSelectionID');
                var subGroupSelect = document.getElementById('subGroupSelectionID');

                subGroupSelect.disabled = true;

                groupSelect.addEventListener('change', function() {
                    var selectedValue = groupSelect.value;
                    subGroupSelect.value = '0';
                    if (selectedValue === '0' || selectedValue === 'NULL') {
                        subGroupSelect.disabled = true;
                    } else {
                        subGroupSelect.disabled = false;
                        updateSubGroupOptions(selectedValue);
                    }
                });

                function updateSubGroupOptions(selectedGroupId) {
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                var data = JSON.parse(xhr.responseText);
                                subGroupSelect.innerHTML = '<option value="0">საერთო</option>';

                                for (var i = 0; i < data.length; i++) {
                                    var option = document.createElement('option');
                                    option.value = data[i].id;
                                    option.text = data[i].hierarchy_name;
                                    subGroupSelect.appendChild(option);
                                }
                            } else {
                                console.error('Error fetching subGroup options:', xhr.statusText);
                            }
                        }
                    };

                    xhr.open('GET', 'selectable_options.php?selectedGroupId=' + selectedGroupId, true);
                    xhr.send();
                }

                document.getElementById('confirmEditButton').addEventListener('click', function() {
                    var userId = document.querySelector('#edit_person_modal input[name="userID"]').value;
                    var room = document.querySelector('#edit_person_modal input[name="room"]').value;
                    var name = document.querySelector('#edit_person_modal input[name="name"]').value;
                    var surname = document.querySelector('#edit_person_modal input[name="surname"]').value;
                    var tel = document.querySelector('#edit_person_modal input[name="tel"]').value;
                    var mobile = document.querySelector('#edit_person_modal input[name="mobile"]').value;
                    var group_id = document.querySelector('#groupSelectionModalID2').value;
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                var response = JSON.parse(xhr.responseText);
                                console.log('Update successful:', response);
                                document.querySelector('#edit_person_modal').classList.remove('show');
                                document.querySelector('.modal-backdrop').remove();
                                refreshPage();
                            } else {
                                console.error('Error updating data:', xhr.statusText);
                            }
                        }
                    };

                    xhr.open('POST', 'update_processing.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send(
                        'userId=' + encodeURIComponent(userId) +
                        '&room=' + encodeURIComponent(room) +
                        '&name=' + encodeURIComponent(name) +
                        '&surname=' + encodeURIComponent(surname) +
                        '&tel=' + encodeURIComponent(tel) +
                        '&mobile=' + encodeURIComponent(mobile) +
                        '&group_id=' + encodeURIComponent(group_id)
                    );
                });
                document.getElementById('deleteButton').addEventListener('click', function() {
                    var userId = document.querySelector('#edit_person_modal input[name="userID"]').value;
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                var response = JSON.parse(xhr.responseText);
                                if (response.status === "success") {
                                    console.log('Delete successful:', response.message);
                                    refreshPage();
                                } else {
                                    console.error('Error deleting user:', response.message);
                                }
                            }
                        }
                    };

                    xhr.open('POST', 'delete_processing.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send('userId=' + encodeURIComponent(userId));
                });
            });

            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        var selectElement = document.getElementById('groupSelectionID');

                        selectElement.innerHTML = '<option value="0">საერთო</option>';

                        for (var i = 0; i < data.length; i++) {
                            var option = document.createElement('option');
                            option.value = data[i].id;
                            option.text = data[i].hierarchy_name;
                            selectElement.add(option);
                        }

                        selectElement.innerHTML += '<option value="NULL">ჯგუფის გარეშე</option>';
                    } else {
                        console.error('Error fetching data:', xhr.statusText);
                    }
                }
            };

            xhr.open('GET', 'selectable_options.php?selectedGroupId=parentGroups', true);
            xhr.send();

            function updateOptions(selectionID, selectedValue) {
                var selectElement = document.getElementById(selectionID);

                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            var data = JSON.parse(xhr.responseText);

                            selectElement.innerHTML = '<option value="NULL">ჯგუფის გარეშე</option>';

                            for (var i = 0; i < data.length; i++) {
                                var option = document.createElement('option');
                                option.value = data[i].id;
                                option.text = data[i].hierarchy_name;

                                selectElement.add(option);
                            }
                            if (selectedValue !== undefined) {
                                for (var i = 0; i < selectElement.options.length; i++) {
                                    if (selectElement.options[i].value == selectedValue) {
                                        selectElement.options[i].selected = true;
                                        break;
                                    }
                                }
                            }
                        } else {
                            console.error('Error fetching data:', xhr.statusText);
                        }
                    }
                };
                xhr.open('GET', 'selectable_options.php', true);
                xhr.send();
            }
            updateOptions('groupSelectionModalID');

            <?php
            $privilegeLevel = isset($_SESSION['privilege']) ? $_SESSION['privilege'] : 0;
            ?>

            var privilegeLevel = <?php echo json_encode($privilegeLevel); ?>;

            $(document).ready(function() {
                if (privilegeLevel == "2") {
                    var dataTable = $('#dataTable1').DataTable({
                        columns: [{
                                "data": "room"
                            },
                            {
                                "data": "name"
                            },
                            {
                                "data": "surname"
                            },
                            {
                                "data": "tel"
                            },
                            {
                                "data": "mobile"
                            },
                            {
                                "data": "hierarchy_name"
                            },
                            {
                                "data": "id",
                                "render": function(data, type, row) {
                                    if (type === "display") {
                                        return '<button id="edit_' + row.user_id + '" value="' + row.id + '" class="btn btn-light edit-btn p-0"><i class="bi bi-pencil-square p-0 fs-3"></i></button>';
                                    }
                                    return data;
                                }
                            }
                        ],
                        initComplete: function() {
                            var api = this.api();

                            $('#globalSearch').on('input', function() {
                                api.search(this.value).draw();
                            });

                            this.api().columns().every(function(index) {
                                var column = this;
                                var title = $(column.header()).text();

                                if (index < api.columns().indexes().length - 1) {
                                    var input = document.createElement('input');
                                    input.className = 'form-control';
                                    input.placeholder = title + 'ს ძიება';

                                    $(input).appendTo($(column.footer()).empty());

                                    $(input).on('keyup change', function() {
                                        if (column.search() !== this.value) {
                                            column.search(this.value).draw();
                                        }
                                    });
                                }
                            });

                            $('#dataTable1 tbody').on('click', '.edit-btn', function() {
                                var data = api.row($(this).parents('tr')).data();

                                var buttonId = $(this).attr('id');
                                var userId = buttonId.replace('edit_', '');

                                $('#edit_person_modal input[name="room"]').val(data.room);
                                $('#edit_person_modal input[name="name"]').val(data.name);
                                $('#edit_person_modal input[name="surname"]').val(data.surname);
                                $('#edit_person_modal input[name="tel"]').val(data.tel);
                                $('#edit_person_modal input[name="mobile"]').val(data.mobile);
                                $('#edit_person_modal input[name="userID"]').val(userId);
                                updateOptions('groupSelectionModalID2', data.id);

                                $('#edit_person_modal').modal('show');
                            });
                        }
                    });

                    function reloadTable(selectedGroupId) {
                        $.ajax({
                            url: 'query_processing.php',
                            method: 'GET',
                            dataType: 'json',
                            data: {
                                selectedGroupId: selectedGroupId
                            },
                            success: function(data) {
                                dataTable.clear().rows.add(data).draw();
                            },
                            error: function(xhr, textStatus, error) {
                                console.error('Error fetching data:', error);
                            }
                        });
                    }

                    $('#groupSelectionID, #subGroupSelectionID').on('change', function() {
                        var selectedGroupId = $(this).val();
                        reloadTable(selectedGroupId);
                    });

                    reloadTable(0);
                } else {
                    var dataTable = $('#dataTable1').DataTable({
                        columns: [{
                                "data": "room"
                            },
                            {
                                "data": "name"
                            },
                            {
                                "data": "surname"
                            },
                            {
                                "data": "tel"
                            },
                            {
                                "data": "mobile"
                            },
                            {
                                "data": "hierarchy_name"
                            }
                        ],
                        initComplete: function() {
                            var api = this.api();

                            $('#globalSearch').on('input', function() {
                                api.search(this.value).draw();
                            });

                            this.api().columns().every(function(index) {
                                var column = this;
                                var title = $(column.header()).text();

                                if (index < api.columns().indexes().length) {
                                    var input = document.createElement('input');
                                    input.className = 'form-control';
                                    input.placeholder = title + 'ს ძიება';

                                    $(input).appendTo($(column.footer()).empty());

                                    $(input).on('keyup change', function() {
                                        if (column.search() !== this.value) {
                                            column.search(this.value).draw();
                                        }
                                    });
                                }
                            });
                        }
                    });

                    function reloadTable(selectedGroupId) {
                        $.ajax({
                            url: 'query_processing.php',
                            method: 'GET',
                            dataType: 'json',
                            data: {
                                selectedGroupId: selectedGroupId
                            },
                            success: function(data) {
                                dataTable.clear().rows.add(data).draw();
                            },
                            error: function(xhr, textStatus, error) {
                                console.error('Error fetching data:', error);
                            }
                        });
                    }

                    $('#groupSelectionID, #subGroupSelectionID').on('change', function() {
                        var selectedGroupId = $(this).val();
                        reloadTable(selectedGroupId);
                    });

                    reloadTable(0);
                }
            });
        </script>
        </script>