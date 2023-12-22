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
    <title>Item Defective</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
include_once "include\commoncss.php";
?>
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
                            <h1>Defective Item Return</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Defective Item Return</li>
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
                        <input type="hidden" id="action" value="add" />
                        <input type="hidden" id="itemAllocationId" value="" />
                        <input type="hidden" id="userQty" value="0" />
                        <!-- /.card-header -->
                        <div class="card-body">

                            <!-- /.row -->
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>User Name</label>
                                        <select name="userId" id="userId" class="form-control select2">
                                            <option selected="selected">Select username </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Item Name (Item Code)</label>
                                        <select name="itemId" id="itemId" class="form-control select2">
                                            <option selected="selected">Select Item</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <label>User Stock</label>
                                        <input type="text" name="userExistingQty" class="form-control defectiveQty"
                                            placeholder="User Stock" id="userExistingQty" disabled>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="text" name="defectiveQty" class="form-control defectiveQty"
                                            placeholder="Defective Qty" id="defectiveQty">
                                    </div>
                                </div>

                                <div class="col-1  text-center mt-4 ">
                                    <div class="form-group">
                                        <button type="button" name="assign" id="assign"
                                            class="btn btn-primary mt-2">Return</button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <table id="listItemTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Item Qty</th>
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
        getUsers();
        resetDataTable('listItemTable');
    });

    function getItemDetails() {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getItemDetails',

        };
        APICallAjax(sendApiDataObj, function(response) {

            if (response.responseCode == RESULT_OK) {

                let html = '<option value="" selected="selected">Select Item</option>';

                $.each(response.result.itemList, function(index, items) {
                    html += '<option value="' + items.id + '">' + items.itemName + ' (' + items
                        .itemCode +
                        ')</option>';
                });
                $('#itemId').html(html)
            }
        });

    }

    function getUsers() {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Sessions',
            '<?php echo systemModuleFunction ?>': 'getUserDetails',

        };
        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {

                let html = '<option value="" selected="selected">Select username </option>';
                $.each(response.result.user, function(index, user) {

                    html += '<option value="' + user.id + '">' + user.firstName + " " + user.lastName +
                        '</option>';
                });
                $('#userId').html(html)
            }
        });
    }


    $("#itemId").change(function() {
        let itemId = $(this).val();
        let userId = $("#userId").val();
        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getItemDefectiveDetails',
            'userId': userId,
            'itemId': itemId

        };
        APICallAjax(sendApiDataObj, function(response) {

            if (response.responseCode == RESULT_OK) {
                $.each(response.result.itemList, function(index, items) {
                    console.log(items.openingStock)
                    $('#itemQty').val(items.openingStock)
                });
            }
        });
        getUserDefectiveItemList();
        getUserItemData();
    });

    function getUserItemData() {
        let userId = $("#userId").val();
        let itemId = $("#itemId").val();
        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getItemAllocationDetails',
            'userId': userId,
            'itemId': itemId

        };
        APICallAjax(sendApiDataObj, function(response) {

            if (response.responseCode == RESULT_OK) {

                $.each(response.result.itemList, function(index, items) {
                    $("#userExistingQty").val(displayViewAmountDigit(items.allocateQty));
                });
            }
        });
    }

    function getUserDefectiveItemList() {
        let userId = $("#userId").val();
        let itemId = $("#itemId").val();
        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getItemDefectiveDetails',
            'userId': userId,

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
                    html += '<td>' + items.itemCode + '</td>';
                    html += '<td>' + items.itemName + '</td>';
                    html += '<td>' + displayViewAmountDigit(items.defectiveQty) + '</td>';
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



    $("#userId").change(function() {
        if ($(this).val() !== '') {
            getUserDefectiveItemList()
        }
    });

    $('#assign').on('click', function(event) {
        let userExistingQty = parseFloat($("#userExistingQty").val());
        let defectiveQty = parseFloat($("#defectiveQty").val());
        let userQty = parseFloat($("#userQty").val());
        let userId = $("#userId").val()
        let itemId = $("#itemId").val()
        let action = $("#action").val()
        let itemAllocationId = $("#itemAllocationId").val()

        if (userId === '') {
            toast_error("Please select user.");
            $("#userId").focus();
            return false;

        }

        if (itemId === '') {
            toast_error("Please select item.");
            $("#itemId").focus();
            return false;

        }

        if (defectiveQty === '' || defectiveQty == '0') {
            toast_error("Please enter qty.");
            $("#defectiveQty").focus();
            return false;

        }

        if (defectiveQty > userExistingQty) {
            toast_error("Please enter valid qty.");
            $("#defectiveQty").focus();
            return false;
        }


        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'addUpdateItemDefective',
            'itemId': itemId,
            'userId': userId,
            'defectiveQty': defectiveQty,
            'action': $('#action').val(),
            'itemAllocationId': itemAllocationId,
        };

        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {
                toast_success(response.message);
                getUserDefectiveItemList();
                resetFormFields()
            } else {
                toast_error(response.message);
            }
        });

    });

    function resetFormFields() {
        $("#itemId").val('').trigger('change');
        $("#action").val('add')
        $("#defectiveQty").val('0')
        $("#itemAllocationId").val('0')
        $("#itemQty").val(0);
        $("#userQty").val(0);
        $("#userExistingQty").val(displayViewAmountDigit(0));
        $("#itemAllocationId").val(0);

    }
    </script>
</body>

</html>