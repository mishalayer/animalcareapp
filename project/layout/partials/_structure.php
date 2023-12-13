<?php
if ($_SESSION["privilege"] != "2") {
    header("Location: index.php");
}
include("database.php");
function isDataNull($colName, $dataName)
{
    if ($dataName == 'NULL') {
        return "$colName is NULL";
    } else {
        return "$colName = '$dataName'";
    }
}

$query = "SELECT id, parent_id, name FROM `groups` ORDER BY ord_id;";
$result = mysqli_query($connection, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

function buildHierarchy($items, $parentId = 0)
{
    $result = array();

    foreach ($items as $item) {
        if ($item['parent_id'] == $parentId) {
            $item['children'] = buildHierarchy($items, $item['id']);
            $result[] = $item;
        }
    }

    return $result;
}

$hierarchy = buildHierarchy($data);

$query = "SELECT MAX(id) as maxID FROM `groups`;";
$result = mysqli_query($connection, $query);
$maxID = mysqli_fetch_assoc($result)['maxID'];
$maxID = !empty($maxID) ? $maxID : 0;
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
                <div id="nested" class="row">
                    <div id="nestedSortable" class="list-group col nested-sortable">

                    </div>
                    <!--end::Content container-->
                </div>
                <br>
                <div class="d-flex justify-content-between">
                    <button id="addElementButton" class="btn fw-bold btn-primary">Add Element</button>
                    <div>
                        <button class="btn btn-light fw-bold btn-active-light-primary me-2" onclick="refreshPage()" data-kt-search-element="preferences-dismiss">Cancel</button>
                        <button id="saveButton" class="btn fw-bold btn-primary" onclick="saveChanges()">Save Changes</button>
                    </div>
                </div>
            </div>
            <!--end::Content-->
            <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
            <script>
                var maxID = <?php echo $maxID ?>;

                function generateHtml(element) {
                    var html = '';
                    for (var i = 0; i < element.length; i++) {
                        var item = element[i];
                        html += '<div id="element_' + item.id + '" class="list-group-item fs-2 customSortable">';
                        html += '<i class="bi bi-list handle fs-2 p-2"></i>';
                        html += '<span class="customSpan" contenteditable="true">' + item.name + '</span>';
                        html += '<i class="bi bi-trash-fill p-2 fs-2 trashButton" onclick="deleteElement(this)"></i>';
                        html += '<i class="bi bi-caret-down-fill p-2 fs-2 collapseButton"></i>';
                        html += '<div class="list-group nested-sortable">';
                        if (item.children && item.children.length > 0) {
                            html += generateHtml(item.children);
                        }
                        html += '</div></div>';
                    }
                    return html;
                }

                document.addEventListener("DOMContentLoaded", function() {
                    var container = document.getElementById("nestedSortable");
                    container.innerHTML = generateHtml(<?php echo json_encode($hierarchy); ?>);
                    var collapseButtons = document.querySelectorAll('.collapseButton');
                    collapseButtons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            var parentItem = this.closest('.customSortable');
                            var nestedSortable = parentItem.querySelector('.nested-sortable');
                            nestedSortable.classList.toggle('customCollapse');
                            this.classList.toggle('collapseRotate');
                        });
                    });

                    var nestedSortables = document.querySelectorAll('.nested-sortable');

                    for (var i = 0; i < nestedSortables.length; i++) {
                        new Sortable(nestedSortables[i], {
                            group: 'nested',
                            animation: 150,
                            fallbackOnBody: true,
                            swapThreshold: 0.25,
                            handle: '.handle'
                        });
                    }
                    var sortableContainer = document.getElementById("nestedSortable");
                    var addElementButton = document.getElementById("addElementButton");
                    addElementButton.addEventListener("click", function() {
                        var newElement = document.createElement("div");
                        maxID++;
                        newElement.id = "element_" + maxID;
                        newElement.className = "list-group-item fs-2 customSortable";
                        newElement.innerHTML = `
            <i class="bi bi-list handle fs-2 p-2"></i>
            <span class="customSpan" contenteditable="true">New Element</span>
            <i class="bi bi-trash-fill p-2 fs-2 trashButton" onclick="deleteElement(this)"></i>
            <i class="bi bi-caret-down-fill p-2 fs-2 collapseButton"></i>
            <div class="list-group nested-sortable"></div>
        `;

                        sortableContainer.appendChild(newElement);
                        var nestedSortables = document.querySelectorAll('.nested-sortable');
                        new Sortable(nestedSortables[nestedSortables.length - 1], {
                            group: 'nested',
                            animation: 150,
                            fallbackOnBody: true,
                            swapThreshold: 0.25,
                            handle: '.handle'
                        });
                        var collapseButtons = document.querySelectorAll('.collapseButton');
                        collapseButtons[collapseButtons.length - 1].addEventListener('click', function() {
                            var parentItem = this.closest('.customSortable');
                            var nestedSortable = parentItem.querySelector('.nested-sortable');
                            nestedSortable.classList.toggle('customCollapse');
                            this.classList.toggle('collapseRotate');
                        });
                    });
                });

                function deleteElement(trashIcon) {
                    var listItem = trashIcon.closest('.list-group-item');
                    listItem.parentNode.removeChild(listItem);
                }

                function refreshPage() {
                    location.reload();
                }

                function saveChanges() {
                    var elementsData = [];
                    var elements = document.querySelectorAll('.customSortable');
                    var order_id = 0;
                    elements.forEach(function(element) {
                        order_id++;
                        var id = element.id.replace('element_', '');
                        var parentElement = element.parentNode.closest('.customSortable');
                        var parentId = parentElement ? parentElement.id.replace('element_', '') : 0;
                        var name = element.querySelector('.customSpan').textContent;
                        elementsData.push({
                            id: id,
                            parent_id: parentId,
                            name: name,
                            ord_id: order_id,
                        });
                    });
                    console.log(elementsData);
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'save_changes.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            console.log(xhr.responseText);
                        }
                    };
                    xhr.send(JSON.stringify(elementsData));
                }
            </script>