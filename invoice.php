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
    <title>Invoice</title>
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
                            <h1>Invoice</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Invoice</li>
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
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-9">

                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Bill No</label>
                                            <input type="text" name="billNo" id="billNo" class="form-control"
                                                placeholder="Enter GST Number" value="B-123">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Client's Name/Company Name</label>
                                            <input type="text" name="clientName"  id="clientName" class="form-control"
                                                placeholder="Enter Name or Company Name"/>
                                            <input type="hidden" id="action" name="action"/>
                                            <input type="hidden" id="gstPercentage" name="gstPercentage"/>
                                            <input type="hidden" id="invoiceId" name="invoiceId"/>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" name="contactNumber" id="contactNumber" class="form-control"
                                                placeholder="Enter Client's Contact Number">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" id="email"
                                                class="form-control" placeholder="Enter Client's Email Id">
                                        </div>

                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>GST No</label>
                                            <input type="text" name="clientGST"  id="clientGST" class="form-control"
                                                placeholder="Enter GST Number">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="2"
                                                placeholder="Enter Client's Address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>State:</label>
                                            <select name="state" id="state" class="form-control select2"
                                                style="width: 100%; ">
                                                <option selected="selected"></option>
                                                <option>Gujarat</option>
                                                <option>Maharastra</option>
                                                <option>Kerala</option>
                                                <option>Punjab</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Item:</label>
                                            <select name="itemId" id="itemId" class="form-control select2 itemId"
                                                style="width: 100%; ">

                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-3 mt-4">
                                        <div class="form-group">
                                            <button type="button" name=" add" class="btn btn-primary mt-2"
                                                onclick="addNewItem">ADD ITEM</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table id="itemTable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%;">Id</th>
                                                    <th style="width: 30%;">Item Name</th>
                                                    <th style="width: 5%;">Item Qty</th>
                                                    <th style="width: 10%;">Rate</th>
                                                    <th style="width: 10%;">Discount</th>
                                                    <th style="width: 10%;">Total</th>
                                                    <th style="width: 5%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>


                                        </table>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-9"></div>
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Total:</label>
                                                    <input type="text" name="invoiceTotalAmount" id="invoiceTotalAmount"
                                                        class="form-control" placeholder="Total amount" disabled>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Total Discount:</label>
                                                    <input type="text" name="invoiceTotalDiscountAmount" id="invoiceTotalDiscountAmount"
                                                        class="form-control" placeholder="Discount" disabled>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Apply GST:</label>
                                                    <select name="gstType"  id="gstType" class="form-control select2 gstType">
                                                        <option value="notApply">Not Apply</option>
                                                        <option value="applyGST">Apply GST</option>
                                                        <option value="applyIGST">Apply IGST</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>GST Amount:</label>
                                                    <input type="text" name="invoiceGSTAmount" id="invoiceGSTAmount"
                                                        class="form-control" placeholder="GST" disabled >

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Round off:</label>
                                                    <input type="text" name="invoiceRoundOff" id="invoiceRoundOff"
                                                        class="form-control" placeholder="Round off"  >

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Net amount:</label>
                                                    <input type="text" name="invoiceNetAmount" id="invoiceNetAmount"
                                                        class="form-control" placeholder="Round off" disabled>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <button type="button" name="submit"  id="addUpdateInvoiceBtn" class="btn btn-primary">
                                            Save</button>
                                        <button type="button" name="share" class="btn btn-danger">Cancel</button>
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
        $("#invoiceTotalAmount").val(displayViewAmountDigit(0));
        $("#invoiceTotalDiscountAmount").val(displayViewAmountDigit(0));
        $("#invoiceGSTAmount").val(displayViewAmountDigit(0));
        $("#invoiceRoundOff").val(displayViewAmountDigit(0));
        $("#invoiceNetAmount").val(displayViewAmountDigit(0));
        // Add an event listener for changes in input fields
        $('#itemTable tbody').on('change', 'input', function() {
            updateTableTotals();
        });
        // Handle item deletion
        $('#itemTable tbody').on('click', '.delete-item', function() {
            $(this).closest('tr').remove(); // Remove the row

            // Reassign input IDs and recalculate totals
            reassignInputIds();
            updateTableTotals();
        });
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
                    html += '<option value="' + items.id + '">' + items.itemName + '</option>';

                });

                $('#itemId').html(html)
            }
        });

    }

    $('#gstType, #invoiceRoundOff').on('change', function() {
        updateTableTotals();
    });

    $('#addUpdateInvoiceBtn').on('click', function() {
        let action = $("#action").val();
        let gstPercentage = $("#gstPercentage").val();
        let billNo = $("#billNo").val();
        let invoiceId = $("#invoiceId").val();
        let clientName = $("#clientName").val();
        let contactNumber = $("#contactNumber").val();
        let email = $("#email").val();
        let clientGST = $("#clientGST").val();
        let address = $("#address").val();
        let state = $("#state").val();
        let invoiceTotalAmount = $("#invoiceTotalAmount").val();
        let invoiceTotalDiscountAmount = $("#invoiceTotalDiscountAmount").val();
        let gstType = $("#gstType").val();
        let invoiceGSTAmount = $("#invoiceGSTAmount").val();
        let invoiceNetAmount = $("#invoiceNetAmount").val();

        let itemArray = [];

        $('#itemTable tbody tr').each(function() {

            let row = $(this);
            let rate = parseFloat(row.find('[data-field="rate"]').val()) || 0;
            let qty = parseFloat(row.find('[data-field="qty"]').val()) || 0;
            let discount = parseFloat(row.find('[data-field="discount"]').val()) || 0;
            let total = (rate * qty) - discount;
            let itemDetails = {
                "itemsId"=>displayViewAmountDigit(parseFloat(row.find('[data-field="rate"]').val()))
        }

            row.find('[data-field="total"]').val(total);
            totalInvoiceAmount = totalInvoiceAmount+total;
            totalDiscountAmount = totalDiscountAmount+discount;
        });
    });

    function addNewItem {


        let itemId = $("#itemId").val();

        if(itemId!==''){
            let sendApiDataObj = {
                '<?php echo systemProject ?>': 'Masters',
                '<?php echo systemModuleFunction ?>': 'getItemDetails',
                'itemId': itemId,

            };
            APICallAjax(sendApiDataObj, function(response) {

                if (response.responseCode == RESULT_OK) {

                    let html = '';

                    $.each(response.result.itemList, function(index, item) {
                        let srNo = $("#itemTable tbody tr").length + 1;

                        html += "<tr>";
                        html += "<td>" + srNo + "</td>";
                        html += "<td>"+item.itemName+"</td>";
                        html += "<td>";
                        html += "<input type='text' class='form-control' id='itemsQty" + srNo +
                            "'  value = '"+displayViewAmountDigit(1)+"' placeholder='Qty' data-field='qty' />"
                        html += "<input type='hidden' id='itemsId_" + srNo + "' value='"+item.id+"'/>";
                        html += "</td>";

                        html += "<td>";
                        html += "<input type='text' class='form-control allowOnlyDigit' id='itemsRate_" + srNo +
                            "' value = '"+displayViewAmountDigit(item.mrp)+"' placeholder = 'Rate'  data-field='rate'/>";
                        html += "</td>";

                        html += "<td>";
                        html += "<input type='text' class='form-control allowOnlyDigit' id='itemsDiscount_" + srNo +
                            "' value = '"+displayViewAmountDigit(0)+"' placeholder = 'items Discount' data-field='discount' />";
                        html += "</td>";
                        html += "<td>";
                        html += "<input type='text' class='form-control allowOnlyDigit' id='total_" + srNo +
                            "' value = ''"+displayViewAmountDigit(1)+"' placeholder = 'items Discount' disabled  data-field='total'/>";
                        html += "</td>";

                        html +=
                            "<td><button type='button' class='btn btn-sm btn-danger delete-item' id='delete' value='' ><i class='fas fa-trash'></i></button></td>";
                        html += "</tr>";
                    });

                    $('#itemTable tbody').append(html)

                }
                updateTableTotals();
            });
        }else{
            toast_error("Please select any item.");
        }
        $("#itemId").val("").trigger("change");
    }

    function reassignInputIds() {
        // Loop through all table rows to reassign input IDs
        $('#itemTable tbody tr').each(function(index) {
            let row = $(this);
            row.find('[data-field="qty"]').attr('id', 'itemsQty' + (index + 1));
            row.find('[data-field="rate"]').attr('id', 'itemsRate_' + (index + 1));
            row.find('[data-field="discount"]').attr('id', 'itemsDiscount_' + (index + 1));
            row.find('[data-field="total"]').attr('id', 'total_' + (index + 1));
            // Optionally, you can also update the item ID input if needed
            row.find('[data-field="itemId"]').attr('id', 'itemsId_' + (index + 1));
        });
    }

    function updateTableTotals() {
        let totalInvoiceAmount =  parseFloat(displayViewAmountDigit(0));
        let totalDiscountAmount = parseFloat(displayViewAmountDigit(0));
        let invoiceNetAmount = parseFloat(displayViewAmountDigit(0));
        let gstType = $("#gstType").val();
        let invoiceRoundOffAmount = displayViewAmountDigit($("#invoiceRoundOff").val());
        let invoiceGSTAmount = parseFloat(displayViewAmountDigit(0));

        $('#itemTable tbody tr').each(function() {
            let row = $(this);
            let rate = parseFloat(row.find('[data-field="rate"]').val()) || 0;
            let qty = parseFloat(row.find('[data-field="qty"]').val()) || 0;
            let discount = parseFloat(row.find('[data-field="discount"]').val()) || 0;
            let total = (rate * qty) - discount;

            row.find('[data-field="total"]').val(total);
            totalInvoiceAmount = totalInvoiceAmount+total;
            totalDiscountAmount = totalDiscountAmount+discount;
        });

        console.log("gstType",gstType)
        if(gstType!=='notApply'){
            invoiceGSTAmount = parseFloat(totalInvoiceAmount)*18/100;
        }else{
            invoiceGSTAmount = displayViewAmountDigit(0);
        }
        // calculation of Net Final Amount
        invoiceNetAmount = parseFloat(totalInvoiceAmount)+parseFloat(invoiceGSTAmount)+parseFloat(invoiceRoundOffAmount);

        $("#invoiceTotalAmount").val(displayViewAmountDigit(totalInvoiceAmount));
        $("#invoiceTotalDiscountAmount").val(displayViewAmountDigit(totalDiscountAmount));
        $("#invoiceGSTAmount").val(displayViewAmountDigit(invoiceGSTAmount));
        $("#invoiceNetAmount").val(displayViewAmountDigit(invoiceNetAmount));
    }
    </script>
</body>

</html>