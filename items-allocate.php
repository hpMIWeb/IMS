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
    <title>items allocate</title>
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
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Items-Allocate</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">item-allocate</li>
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
                        <form method="POST" action="">

                            <!-- /.card-header -->
                            <div class="card-body">

                                <!-- /.row -->
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Item Name</label>
                                            <select name="itemId" id="itemId" class="form-control select2">
                                                <option selected="selected">Select Item</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <select name="userId" id="userId" class="form-control select2">
                                                <option selected="selected">Select username </option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Item Qty</label>
                                            <input type="text" name="itemQty" id="itemQty" disabled
                                                class="form-control itemQty" placeholder="Enter Qty">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Total</label>
                                            <input type="text" name="allocatedQty" class="form-control allocatedQty"
                                                placeholder="Total">
                                            <span>Qty You have : - <p id="userExistingQty"></p></span>
                                        </div>
                                    </div>

                                    <div class="col-1  text-center mt-4 ">
                                        <div class="form-group">
                                            <button type="button" name=" assign "
                                                class="btn btn-primary mt-2">Assign</button>
                                        </div>


                                    </div>


                                </div>

                            </div>


                    </div>
                    </form>
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
        getUsers();

    });

    function getItemDetails() {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getItemDetails',

        };
        APICallAjax(sendApiDataObj, function(response) {

            if (response.responseCode == RESULT_OK) {

                let html = '<option selected="selected">Select Item</option>';

                $.each(response.result.itemList, function(index, items) {
                    html += '<option value="' + items.id + '">' + items.itemName + '</option>';

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

                let html = '<option selected="selected">Select username </option>';
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
        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getItemDetails',
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
    });
    </script>
</body>

</html>