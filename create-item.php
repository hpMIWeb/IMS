<?php
include_once './include/session-check.php';
include_once './include/common-constat.php';
include_once './include/APICALL.php';
$itemId = isset($_GET['id']) ? $_GET['id'] : 0


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>create</title>
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
                            <h1>Item</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">item</li>
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
                        <form>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="itemId" id="itemId" value="<?php echo $itemId; ?>">
                                    <input type="hidden" name="action" id="action" value="add">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Item Name:</label>
                                            <input type="text" name="itemName" id="itemName" class="form-control" placeholder="Enter Item Name">
                                        </div>
                                        <!-- /.form-group -->

                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Hsn Code</label>
                                            <input type="text" name="hsnCode" id="hsnCode" class="form-control" placeholder="Enter Hsn Code">
                                        </div>
                                        <div class="form-group">
                                            <label>Minimum Stock Level</label>
                                            <input type="text" name="minimumStockLevel" id="minimumStockLevel" class="form-control" placeholder="Enter Minimum Stock Level">
                                        </div>
                                        <div class="form-group">
                                            <label>Purchase Basic Cost</label>
                                            <input type="text" name="purchaseBasicCost" id="purchaseBasicCost" class="form-control" placeholder="Enter Purchase Basic Cost">
                                        </div>
                                        <div class="form-group">
                                            <label>MRP</label>
                                            <input type="text" name="mrp" id="mrp" class="form-control" placeholder="Enter MRP">
                                        </div>

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <label>Item Code</label>
                                        <input type="text" name="itemCode" id="itemCode" class="form-control" placeholder="Enter Item Code">

                                        <!-- /.form-group -->
                                        <div class="form-group">

                                        </div>

                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Opening Stock</label>
                                            <input type="text" name="openingStock" id="openingStock" class="form-control" placeholder="Enter Opening Stock">
                                        </div>
                                        <div class="form-group">
                                            <label>Landing Cost</label>
                                            <input type="text" name="landingCost" id="landingCost" class="form-control" placeholder="Enter Lending Cost">
                                        </div>
                                        <div class="form-group">
                                            <label>Basic Selling Cost </label>
                                            <input type="text" name="basicSellingPrice" id="basicSellingPrice" class="form-control" placeholder="Enter Basic Selling Price">
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->


                                <div class="float-right">
                                    <button type="button" id="addUpdateItemButton" name="submit" class="btn btn-primary">Save</button>
                                    <button type="button" name="delete" class="btn btn-danger" onclick="resetFormFields()">Cancel</button>
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
            let itemId = $('#itemId').val();
            if (itemId !== '0') {
                getItemDetails(itemId)
            }

        });

        function getItemDetails(itemId) {

            let sendApiDataObj = {
                '<?php echo systemProject ?>': 'Masters',
                '<?php echo systemModuleFunction ?>': 'getItemDetails',
                'itemId': itemId
            };
            APICallAjax(sendApiDataObj, function(response) {
                if (response.responseCode == RESULT_OK) {

                    $.each(response.result.itemList, function(index, item) {
                        $('#itemName').val(item.itemName);
                        $('#itemCode').val(item.itemCode);
                        $('#hsnCode').val(item.hsnCode);
                        $('#openingStock').val(item.openingStock);
                        $('#minimumStockLevel').val(item.minimumStockLevel);
                        $('#basicSellingPrice').val(item.basicSellingPrice);
                        $('#landingCost').val(item.landingCost);
                        $('#purchaseBasicCost').val(item.purchaseBasicCost);
                        $('#mrp').val(item.mrp);
                        $('#action').val('edit');

                    });
                } else {
                    toast_error(response.message);
                }
            });
        }


        $('#addUpdateItemButton').on('click', function(event) {
            let itemName = $('#itemName').val();
            let itemCode = $('#itemCode').val();
            let hsnCode = $('#hsnCode').val();
            let openingStock = $('#openingStock').val();
            let minimumStockLevel = $('#minimumStockLevel').val();
            let purchaseBasicCost = $('#purchaseBasicCost').val();
            let basicSellingPrice = $('#basicSellingPrice').val();
            let landingCost = $('#landingCost').val();
            let mrp = $('#mrp').val();
            let action = $('#action').val();
            let itemId = $('#itemId').val();
            let sendApiDataObj = {
                '<?php echo systemProject ?>': 'Masters',
                '<?php echo systemModuleFunction ?>': 'addUpdateItem',
                'itemId': itemId,
                'itemName': itemName,
                'itemCode': itemCode,
                'hsnCode': hsnCode,
                'openingStock': openingStock,
                'minimumStockLevel': minimumStockLevel,
                'purchaseBasicCost': purchaseBasicCost,
                'basicSellingPrice': basicSellingPrice,
                'landingCost': landingCost,
                'mrp': mrp,
                'action': action,
            };

            APICallAjax(sendApiDataObj, function(response) {
                if (response.responseCode == RESULT_OK) {
                    toast_success(response.message);
                    window.location = "list-item.php";
                    resetFormFields()
                } else {
                    toast_error(response.message);
                }
            });
        });

        // Function to reset form fields
        function resetFormFields() {
            $('#itemName').val('');
            $('#lastName').val('');
            $('#userName').val('');
            $('#address').val('');
            $('#state').val('');
            $('#mobile').val('');
            $('#password').val('');
            $('#email').val('');
            $('#action').val('add');
            $('#itemId').val();
        }
    </script>
</body>

</html>