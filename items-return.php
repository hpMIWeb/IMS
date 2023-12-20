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
    <title>Items Return</title>
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
                            <h1>New Item Return</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">New Item Return</li>
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
                                            <option selected="selected">Select Username </option>

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

                                <!-- <div class="col-2">
                                    <div class="form-group">
                                        <label>LIVE STOCK(Qty)</label>
                                        <input type="text" name="itemQty" id="itemQty" disabled
                                            class="form-control itemQty" placeholder="Item Qty">
                                    </div>
                                </div> -->
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>User Stock (Qty)</label>
                                        <input type="text" name="userExistingQty" id="userExistingQty" disabled
                                            class="form-control itemQty" placeholder="User Stock Item Qty">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Return Qty</label>
                                        <input type="text" name="allocatedQty" class="form-control allocatedQty"
                                            placeholder="Return Qty" id="allocatedQty">

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
                let html = '<option  value="" selected="selected">Select Item</option>';
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

    function getUserAllocatedItemList() {
        let userId = $("#userId").val();
        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getItemAllocationDetails',
            'userId': userId

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
                    html += '<td>' + displayViewAmountDigit(items.allocateQty) + '</td>';
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

    $("#itemId").change(function() {

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
                    $("#userQty").val(displayViewAmountDigit(items.allocateQty));
                    $("#userExistingQty").val(displayViewAmountDigit(items.allocateQty));
                    $("#itemAllocationId").val(items.id);
                    $("#action").val("edit");
                });
            }
        });
    }

    $("#userId").change(function() {
        if ($(this).val() !== '') {
            getUserAllocatedItemList()
        }
    });

    $("#allocatedQty").change(function() {
        let itemQty = parseFloat($("#itemQty").val());
        if (parseFloat($(this).val()) > itemQty) {
            toast_error("Enter Qty is Greater than to item Qty Please change it .");
            $(this).focus();
            return false;
        }

    });

    $('#assign').on('click', function(event) {
        let itemQty = parseFloat($("#itemQty").val());
        let allocatedQty = parseFloat($("#allocatedQty").val());
        let userQty = parseFloat($("#userQty").val());
        let userExistingQty = parseFloat($("#userExistingQty").val());
        let userId = $("#userId").val()
        let itemId = $("#itemId").val()
        let action = $("#action").val()
        let itemAllocationId = $("#itemAllocationId").val()



        console.log(allocatedQty > itemQty)
        if (allocatedQty > itemQty) {
            toast_error("Enter Qty is Greater than to item Qty Please change it .");
            $(this).focus();
            return false;
        }

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

        if (allocatedQty === '' || allocatedQty == '0') {
            toast_error("Please enter qty.");
            $("#allocatedQty").focus();
            return false;

        }
        if (userExistingQty < allocatedQty) {
            toast_error("Please enter valid qty.");
            $("#allocatedQty").focus();
            return false;

        }


        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'addUpdateItemReturn',
            'itemId': itemId,
            'userId': userId,
            'allocatedQty': allocatedQty,
            'action': $('#action').val(),
            'itemAllocationId': itemAllocationId,
        };

        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {
                toast_success(response.message);
                getUserAllocatedItemList();
                resetFormFields()
            } else {
                toast_error(response.message);
            }
        });

    });

    function resetFormFields() {
        $("#itemId").val('').trigger('change');
        $("#action").val('add')
        $("#allocatedQty").val(displayViewAmountDigit(0))
        $("#itemAllocationId").val(displayViewAmountDigit(0))
        $("#userExistingQty").val(displayViewAmountDigit(0));
        $("#itemQty").val(0);
        $("#userQty").val(0);
        $("#itemAllocationId").val(0);

    }
    </script>
</body>

</html>