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
    <title>Item List</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
include_once "include\commoncss.php";
?>
    <style>
    /* Add this to your CSS file or within a style tag in your HTML */

    /* Define the background color for outOfStock rows */
    .outOfStock {
        background-color: #ffcccc;
        /* Light red, adjust the color as needed */
        /* You can add more styles here, depending on your design preferences */
    }

    /* Optional: Add hover effect for better user interaction */
    .outOfStock:hover {
        background-color: #ff9999;
        /* Lighter red on hover, adjust as needed */
    }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php
include_once "include/header.php";
include_once "include/sidebar.php";

?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Item List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Item List</li>
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
                                                <th style="width: 10%;">Sr. No.</th>
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Item Stock</th>
                                                <th>Item Rate</th>
                                                <th style="width: 10%;">Action</th>
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

    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Warning</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="deleteMsg">Are you Sure want to Delete?</p>
                    <input id="deleteItemId" value="" type="hidden">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="deleteItems()">Delete</button>
                </div>
            </div>

        </div>

    </div>
    <?php

include_once "include/footer.php";

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

include_once "include/jquery.php";

?>

    <script>
    $(document).ready(function() {
        getItemDetails();
        resetDataTable('listItemTable');
    });
    // Add a click event handler for the "Delete" buttons
    $('#listItemTable').on('click', '.delete-item', function(event) {
        event.preventDefault(); // Prevent the default link behavior

        const itemId = $(this).data('items-id');
        const itemName = $(this).data('items-name');
        $('#deleteMsg').html('Are you Sure want to delete <b>' + itemName + ' ?');

        $('#deleteItemId').val(itemId);
        $('#modal-sm').modal('show');
        //  deleteItems(itemId);
    });


    function deleteItems() {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'deleteItems',
            'itemId': $('#deleteItemId').val(),
        };
        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {
                toast_success(response.message);
                $('#modal-sm').modal('hide');
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

                    let rowClass = "";

                    if (parseFloat(items.openingStock) < parseFloat(items.minimumStockLevel)) {
                        rowClass = "outOfStock";
                    }

                    html += '<tr class="' + rowClass + '">';
                    html += '<td>' + count + '</td>';
                    html += '<td>' + items.itemCode + '</td>';
                    html += '<td>' + items.itemName + '</td>';
                    html += '<td>' + displayViewAmountDigit(items.openingStock) + '</td>';
                    html += '<td>' + displayIndianRupeeCurrency(items.mrp) + '</td>';
                    html += '<td class="text-center-block py-0 align-middle">';
                    html += '<div class = "" > ';
                    html +=
                        ' <button  class="btn btn-warning btn-sm edit-item" data-items-id="' +
                        items.id + '">';
                    html += '<i class = "fas fa-pen" > </i>';
                    html += '</button>';
                    html +=
                        ' <button class="btn btn-danger btn-sm delete-item" data-items-id="' +
                        items.id + '" data-items-name="' +
                        items.itemName + '">';
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

    }
    // Function to reset form fields
    function resetFormFields() {
        $('#itemName').val('');
        $('#minimumStockLevel').val('');
        $('#mrp').val('');
        $('#action').val('add');
    }
    </script>
</body>

</html>