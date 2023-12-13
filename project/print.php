<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        @media print {
            @page {
                size: A4 landscape;
                margin: 0;
            }

            body {
                column-count: 2;
                column-gap: 20px;
                column-fill: auto;
            }

            .page {
                page-break-inside: avoid;
                break-inside: avoid-column;
                overflow: hidden;
            }

            .page+.page {
                page-break-before: always;
            }

            .table {
                width: 100%;
            }
        }
    </style>
</head>

<?php
include "database.php";
?>

<?php
function printGroup($connection, $parentId = 0, $isRoot = true)
{
    $groupQuery = "SELECT id, name FROM groups WHERE parent_id = $parentId ORDER BY ord_id";
    $groupResult = mysqli_query($connection, $groupQuery);

    while ($groupRow = mysqli_fetch_assoc($groupResult)) {
        $groupId = $groupRow['id'];
        $groupName = $groupRow['name'];

        if ($isRoot) {
            echo "<div class='page'>";
        }

        echo "<div id='group_$groupId'>";
        echo "<div class='d-flex justify-content-center my-2'><b>$groupName</b></div>";

        if ($isRoot) {
            echo "
            <table class='table table-borderless mx-auto text-center'>
                <thead>
                    <tr>
                        <th class='col-1'>ოთახი</th>
                        <th class='col-3'>სახელი</th>
                        <th class='col-4'>გვარი</th>
                        <th class='col-2'>ტელ.</th>
                        <th class='col-2'>მობილური</th>
                    </tr>
                </thead>
            </table>";
        }

        echo "</div>";

        $userQuery = "SELECT room, name, surname, tel, mobile FROM usertable WHERE group_id = $groupId";
        $userResult = mysqli_query($connection, $userQuery);

        while ($userRow = mysqli_fetch_assoc($userResult)) {
            echo "<div class='user-row'>";
            echo "<table class='table table-borderless mx-auto my-0 text-center'>";
            echo "<tr>
                    <td class='col-1'>{$userRow['room']}</td>
                    <td class='col-3'>{$userRow['name']}</td>
                    <td class='col-4'>{$userRow['surname']}</td>
                    <td class='col-2'>{$userRow['tel']}</td>
                    <td class='col-2'>{$userRow['mobile']}</td>
                  </tr>";
            echo "</table>";
            echo "</div>";
        }

        printGroup($connection, $groupId, false);

        if ($isRoot) {
            echo "</div>";
        }

        mysqli_free_result($userResult);
    }

    mysqli_free_result($groupResult);
}
?>

<body>
    <div class="container">
        <?php
        printGroup($connection);
        ?>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>