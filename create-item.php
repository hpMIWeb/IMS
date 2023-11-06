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
                            <h1>Item Create</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Item Create</li>
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

                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="itemId" id="itemId" value="<?php echo $itemId; ?>">
                                <input type="hidden" name="action" id="action" value="add">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Item Name:</label>
                                        <input type="text" name="itemName" id="itemName" class="form-control"
                                            placeholder="Enter Item Name">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Item Code</label>
                                        <input type="text" name="itemCode" id="itemCode" class="form-control"
                                            placeholder="Enter Item Code">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Hsn Code</label>
                                        <input type="text" name="hsnCode" id="hsnCode" class="form-control"
                                            placeholder="Enter Hsn Code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Opening Stock</label>
                                        <input type="text" name="openingStock" id="openingStock"
                                            class="form-control allowOnlyDigit openingStock"
                                            placeholder="Enter Opening Stock">
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Minimum Stock Level</label>
                                        <input type="text" name="minimumStockLevel" id="minimumStockLevel"
                                            class="form-control allowOnlyDigit minimumStockLevel"
                                            placeholder="Enter Minimum Stock Level">
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Purchase Basic Cost</label>
                                        <input type="text" name="purchaseBasicCost" id="purchaseBasicCost"
                                            class="form-control allowOnlyDigit purchaseBasicCost"
                                            placeholder="Enter Purchase Basic Cost">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Tax</label>
                                        <input type="text" name="purchaseBasicCostTax" id="purchaseBasicCostTax"
                                            class="form-control allowOnlyDigit purchaseBasicCostTax"
                                            placeholder="Enter Tax">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Landing Cost</label>
                                        <input type="text" name="landingCost" id="landingCost"
                                            class="form-control allowOnlyDigit landingCost"
                                            placeholder="Enter Lending Cost">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Basic Selling Cost </label>
                                        <input type="text" name="basicSellingPrice" id="basicSellingPrice"
                                            class="form-control allowOnlyDigit basicSellingPrice"
                                            placeholder="Enter Basic Selling Price">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Tax</label>
                                        <input type="text" name="basicSellingPriceTax" id="basicSellingPriceTax"
                                            class="form-control allowOnlyDigit basicSellingPriceTax"
                                            placeholder="Enter Tax">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>MRP</label>
                                        <input type="text" name="mrp" id="mrp" class="form-control allowOnlyDigit mrp"
                                            placeholder="Enter MRP">
                                    </div>

                                </div>

                            </div>
                            <div class="float-right">
                                <button type="button" id="addUpdateItemButton" name="submit"
                                    class="btn btn-primary">Save</button>
                                <a href="list-item.php" type="button" name="delete" class="btn btn-danger">Cancel</a>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
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


    //find Basic Selling Cost calculation
    function updateBasicSellingCost() {
        let mrp = parseFloat($("#mrp").val());
        let basicSellingPriceTax = parseFloat($("#basicSellingPriceTax").val());
        let basicSellingPrice = parseFloat($("#basicSellingPrice").val());
        let taxAmount = 0
        if (!isNaN(mrp) && !isNaN(basicSellingPriceTax)) {
            taxAmount = (mrp * basicSellingPriceTax) / 100;
        }

        $("#basicSellingPrice").val(displayViewAmountDigit((mrp - taxAmount)));

    }
    $('#mrp').on('change', updateBasicSellingCost);

    //find landing cost calculation
    function updateLandingCost() {
        let purchaseBasicCost = parseFloat($("#purchaseBasicCost").val());
        let purchaseBasicCostTax = parseFloat($("#purchaseBasicCostTax").val());
        let landingCost = parseFloat($("#landingCost").val());
        let taxAmount = 0

        if (!isNaN(purchaseBasicCost) && !isNaN(purchaseBasicCostTax)) {
            $("#basicSellingPriceTax").val((purchaseBasicCostTax))
            taxAmount = (purchaseBasicCost * purchaseBasicCostTax) / 100;
        }

        $("#landingCost").val(displayViewAmountDigit((purchaseBasicCost + taxAmount)));
    }


    $('#purchaseBasicCost').on('change', updateLandingCost);
    $('#purchaseBasicCostTax').on('change', updateLandingCost);
    $('#landingCost').on('change', updateLandingCost);


    $('#addUpdateItemButton').on('click', function(event) {
        let itemName = $('#itemName').val();
        let itemCode = $('#itemCode').val();
        let hsnCode = $('#hsnCode').val();
        let openingStock = $('#openingStock').val();
        let minimumStockLevel = $('#minimumStockLevel').val();
        let purchaseBasicCost = $('#purchaseBasicCost').val();
        let basicSellingPrice = $('#basicSellingPrice').val();
        let purchaseBasicCostTax = parseFloat($("#purchaseBasicCostTax").val());
        let basicSellingPriceTax = parseFloat($("#basicSellingPriceTax").val());
        let landingCost = $('#landingCost').val();
        let mrp = $('#mrp').val();
        let action = $('#action').val();
        let itemId = $('#itemId').val();

        if (itemName === '') {
            toast_error("Please enter item name.");
            $('#itemName').focus();
            return false;
        }
        if (itemCode === '') {
            toast_error("Please enter item code.");
            $('#itemCode').focus();
            return false;
        }
        if (hsnCode === '') {
            toast_error("Please enter item hsn code.");
            $('#hsnCode').focus();
            return false;
        }

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
            'purchaseBasicCostTax': purchaseBasicCostTax,
            'basicSellingPriceTax': basicSellingPriceTax,
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