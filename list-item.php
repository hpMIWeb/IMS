<?php
session_start();
include_once './include/session-check.php';
include_once './include/APICALL.php';
include_once './include/common-constat.php';


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>List</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    include_once("include\commoncss.php");
    ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php
        include_once("include/header.php");
        include_once("include/sidebar.php");

        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fl">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <div class="float-right">
                                        <a href="create-item.php" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Add
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table id="listItemTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Item Name</th>
                                                <th>Item Qty</th>
                                                <th>Item Rate</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

        </div>

    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <?php

    include_once("include/footer.php");

    ?>

    <!-- Control Sidebar -->
    <aside class=" control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->

    <?php

    include_once("include/jquery.php");

    ?>

    <script>
        $(document).ready(function() {
            getItemDetails();
            resetDataTable('listItemTable');
        });
        // Add a click event handler for the "Delete" buttons
        $('#listItemTable').on('click', '.delete-item', function(event) {
            event.preventDefault(); // Prevent the default link behavior

            const itemId = $(this).data(
                'items-id'); // Get the item ID from the data attribute

            deleteItems(itemId);
        });


        function deleteItems(itemId) {

            let sendApiDataObj = {
                '<?php echo systemProject ?>': 'Masters',
                '<?php echo systemModuleFunction ?>': 'deleteItems',
                'itemId': itemId,
            };
            APICallAjax(sendApiDataObj, function(response) {
                if (response.responseCode == RESULT_OK) {
                    toast_success(response.message);
                    getItemDetails();
                } else {
                    toast_error(response.message);
                }
            });
        }

        $('#listItemTable').on('click', '.edit-item', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            const itemId = $(this).data(
                'items-id'); // Get the category ID from the data attribute
            window.location = "create-item.php?id=" +
                itemId
        });

        function getItemDetails() {

            let sendApiDataObj = {
                '<?php echo systemProject ?>': 'Masters',
                '<?php echo systemModuleFunction ?>': 'getItemDetails',

            };
            APICallAjax(sendApiDataObj, function(response) {
                $("#listItemTable").dataTable().fnDestroy();
                $('#listItemTable tbody').html('');
                if (response.responseCode == RESULT_OK) {

                    let html = '';
                    let count = 1;

                    $.each(response.result.itemList, function(index, items) {
                        html += '<tr>';
                        html += '<td>' + count + '</td>';
                        html += '<td>' + items.itemName + '</td>';
                        html += '<td>' + items.minimumStockLevel + '</td>';
                        html += '<td>' + items.mrp + '</td>';
                        html += '<td class="text-center-block py-0 align-middle">';
                        html += '<div class = "" > ';
                        html +=
                            ' <button  class="btn btn-warning btn-sm edit-item" data-items-id="' +
                            items.id + '">';
                        html += '<i class = "fas fa-pen" > </i>';
                        html += '</button>';
                        html +=
                            ' <button class="btn btn-danger btn-sm delete-item" data-items-id="' +
                            items.id + '">';
                        html += '<i class = "fas fa-trash" > </i>';
                        html += '</button>';
                        html += '</div>';
                        html += '</td > ';
                        html += '</tr>';
                        count++;

                    });

                    $('#listItemTable tbody').html(html);
                    resetDataTable('listItemTable');
                } else {
                    resetDataTable('listItemTable');
                    toast_error(response.message);
                }
            });
            // Function to reset form fields
            function resetFormFields() {
                $('#itemName').val('');
                $('#minimumStockLevel').val('');
                $('#mrp').val('');
                $('#action').val('add');
            }
        }
    </script>
</body>

</html>