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
                            <h1>Invoice Create</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Invoice Create</li>
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
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Client:</label>
                                            <select name="Client" id="clientId" class="form-control select2"
                                                style="width: 100%; ">
                                                <option value="0"> Select Client Type</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Invoice Type:</label>
                                            <select name="invoiceType" id="invoiceType" class="form-control select2"
                                                style="width: 100%; ">
                                                <option value="0"> Select Invoice Type</option>
                                                <option value="1">Cash Memo</option>
                                                <option value="2">GST Invoice</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Date:</label>
                                            <div class="input-group date" id="reservationdate"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input "
                                                    data-target="#reservationdate" id="invoiceDate">
                                                <div class="input-group-append" data-target="#reservationdate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Bill No</label>
                                            <input type="text" name="billNo" id="billNo" class="form-control"
                                                placeholder="Enter GST Number" value="" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Client's Name/Company Name</label>
                                            <input type="text" name="clientName" id="clientName" class="form-control"
                                                placeholder="Enter Name or Company Name" />
                                            <input type="hidden" id="action" name="action" value="add" />
                                            <input type="hidden" id="invoiceId" name="invoiceId" />
                                            <input type="hidden" id="displayNumber" name="displayNumber" />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" name="contactNumber" id="contactNumber"
                                                class="form-control" placeholder="Enter Client's Contact Number">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                placeholder="Enter Client's Email Id">
                                        </div>

                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>GST No</label>
                                            <input type="text" name="clientGST" id="clientGST" class="form-control"
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
                                                <option value="" selected="selected"> Select State</option>
                                                <?php
foreach ($indian_states as $key => $name) {?>
                                                <option value="<?php echo $name; ?>"> <?php echo $name; ?>
                                                </option>

                                                <?php }?>

                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <table id="itemTable" class="table table-bordered table-hover table-responsive"
                                            style="overflow-x: auto;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%;">Sr. No.</th>
                                                    <th style="width: 10%;">Item Code</th>
                                                    <th style="width: 10%;">HSN Code</th>
                                                    <th style="width: 10%;">Qty</th>
                                                    <th style="width: 10%;">Rate</th>
                                                    <th style="width: 10%;">Discount</th>
                                                    <th style="width: 10%;">Discount Amount</th>
                                                    <th style="width: 10%;">GST</th>
                                                    <th style="width: 10%;">GST Amount</th>
                                                    <th style="width: 10%;">Total</th>
                                                    <th style="width: 10%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>


                                        </table>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Remark:</label>
                                                    <textarea rows="2" name="remark" id="remark" class="form-control"
                                                        placeholder="Remark"></textarea>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <input type="text" name="invoiceTotalDiscountAmount"
                                                        id="invoiceTotalDiscountAmount" class="form-control"
                                                        placeholder="Discount" disabled>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>CGST:</label>
                                                    <input type="text" name="invoiceCGSTAmount" id="invoiceCGSTAmount"
                                                        class="form-control" placeholder="GST" disabled>

                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>SGST:</label>
                                                    <input type="text" name="invoiceSGSTAmount" id="invoiceSGSTAmount"
                                                        class="form-control" placeholder="GST" disabled>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>IGST:</label>
                                                    <input type="text" name="invoiceIGSTAmount" id="invoiceIGSTAmount"
                                                        class="form-control" placeholder="IGST" disabled>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Round off:</label>
                                                    <input type="text" name="invoiceRoundOff" id="invoiceRoundOff"
                                                        class="form-control" placeholder="Round off">

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
                                        <button type="button" name="submit" id="addUpdateInvoiceBtn"
                                            class="btn btn-primary">
                                            Save</button>
                                        <a href="invoice-list.php" class="btn btn-danger">Cancel</a>
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
    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'DD-MM-YYYY', // Use 'DD-MM-YYYY' for the desired format
        defaultDate: new Date() // Set the default date to today
    });
    let itemList = []
    $(document).ready(function() {



        let stateDropDown = '<option value="">Select State</option>';

        $.each(IndiaStateArray, function(index, phoneBookMaster) {
            stateDropDown += '<option value="' + phoneBookMaster + '">' + phoneBookMaster +
                '  </option>';
        });
        $('#stated').html(stateDropDown);

        $("#invoiceType").val(1).select2();
        getLastDisplayNumber()
        getItemDetails();
        addNewItemRow();
        getClientDetails();
        $("#invoiceTotalAmount").val(displayViewAmountDigit(0));
        $("#invoiceTotalDiscountAmount").val(displayViewAmountDigit(0));
        $("#invoiceGSTAmount").val(displayViewAmountDigit(0));
        $("#invoiceRoundOff").val(displayViewAmountDigit(0));
        $("#invoiceNetAmount").val(displayViewAmountDigit(0));
    });


    // Add an event listener for changes in input fields
    $('#invoiceType').on('change', function() {
        getLastDisplayNumber()
    });

    function getItemDetails() {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getItemDetails',

        };
        APICallAjax(sendApiDataObj, function(response) {

            if (response.responseCode == RESULT_OK) {

                itemList = response.result.itemList
            }
        });

    }

    function getClientDetails() {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getPhoneBookMasterDetails',


        };
        APICallAjax(sendApiDataObj, function(response) {

            let html = '<option value="">Select Client</option>';
            if (response.responseCode == RESULT_OK) {

                $.each(response.result.phoneBookMaster, function(index, phoneBookMaster) {
                    html += '<option value="' + phoneBookMaster.id + '">' + phoneBookMaster
                        .companyName + '  </option>';
                });
            }

            $('#clientId').html(html);
        });

    }

    function getLastDisplayNumber() {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getLastDisplayNumber',
            'invoiceDate': $("#invoiceDate").val(),
            'invoiceType': $("#invoiceType").val()

        };
        APICallAjax(sendApiDataObj, function(response) {

            if (response.responseCode == RESULT_OK) {
                $('#billNo').val("INV-" + response.result.maxDisplayNumber)
                $('#displayNumber').val(response.result.maxDisplayNumber)
            }
        });

    }

    function prepareItemDropDown() {

        let html = "<select name='itemId' class='form-control select2 itemId'  data-field='itemid'>";
        html += "<option  value=''>Select Item</option>";

        $.each(itemList, function(index, items) {
            html += '<option value="' + items.id + '">' + items.itemName + ' (' + items.itemCode +
                ')   </option>';

        });
        html += "</select>";

        return html;

    }


    $('#addUpdateInvoiceBtn').on('click', function() {
        let action = $("#action").val();
        let invoiceDate = $("#invoiceDate").val();
        let displayNumber = $("#displayNumber").val();
        let invoiceType = $("#invoiceType").val();
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
        let invoiceGSTAmount = parseFloat($("#invoiceCGSTAmount").val()) + parseFloat($("#invoiceSGSTAmount")
            .val());
        let invoiceNetAmount = $("#invoiceNetAmount").val();
        let remark = $("#remark").val();
        let invoiceRoundOff = $('#invoiceRoundOff').val()

        if (invoiceType == 0) {
            toast_error("Please Select Invoice Type");
            $("#invoiceType").focus()
            return false;
        }
        let itemsData = [];

        $('#itemTable tbody tr').each(function(index) {
            let row = $(this);
            let item = {
                itemId: parseFloat(row.find('[data-field="itemid"]').val()) || 0,
                itemQty: parseFloat(row.find('[data-field="qty"]').val()) || 0,
                itemRate: parseFloat(row.find('[data-field="rate"]').val()) || 0,
                itemDiscount: parseFloat(row.find('[data-field="discount"]').val()) || 0,
                itemDiscountAmount: parseFloat(row.find('[data-field="itemsDiscountAmount"]')
                    .val()) || 0,
                itemGST: parseFloat(row.find('[data-field="itemsGSTPer"]')
                    .val()) || 0,
                itemGSTAmount: parseFloat(row.find('[data-field="itemsGSTAmount"]')
                    .val()) || 0,
                total: parseFloat(row.find('[data-field="total"]').val()) || 0
            };
            itemsData.push(item);
        });



        let jsonData = JSON.stringify(itemsData);

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'addUpdateInvoiceDetails',
            'action': action,
            'invoiceId': invoiceId,
            'invoiceDate': invoiceDate,
            'invoiceType': invoiceType,
            'displayNumber': displayNumber,
            'billNo': billNo,
            'clientName': clientName,
            'contactNumber': contactNumber,
            'email': email,
            'clientGST': clientGST,
            'address': address,
            'state': state,
            'invoiceTotalAmount': invoiceTotalAmount,
            'invoiceTotalDiscountAmount': invoiceTotalDiscountAmount,
            'gstType': gstType,
            'invoiceGSTAmount': invoiceGSTAmount,
            'invoiceNetAmount': invoiceNetAmount,
            'remark': remark,
            'itemArray': JSON.stringify(itemsData),
            'invoiceRoundOff': invoiceRoundOff

        };
        APICallAjax(sendApiDataObj, function(response) {

            if (response.responseCode == RESULT_OK) {
                toast_success(response.messages)
                window.location = "invoice-list.php";
            } else {
                toast_error(response.messages)
            }
        });


    });



    function addNewItemRow() {
        let rowNumber = $('#itemTable tbody tr').length + 1;
        let html = "<tr>";
        html += "<td>" + rowNumber + "</td>";
        html += "<td>" + prepareItemDropDown() + "</td>";
        html += "<td><span data-field='hsn'></span></td>";
        html += "<td>";
        html += "<input type='text' class='form-control' name='itemsQty" + rowNumber +
            "' value='" + displayViewAmountDigit(1) + "' placeholder='Qty' data-field='qty' />";
        html += "</td>";
        html += "<td>";
        html += "<input type='text' class='form-control' name='itemsRate" + rowNumber +
            "' value='" + displayViewAmountDigit(0) + "' placeholder='Rate' data-field='rate'/>";
        html += "</td>";
        html += "<td>";
        html += "<input type='text' class='form-control allowOnlyDigit' name='itemsDiscount" + rowNumber +
            "' value='" + displayViewAmountDigit(0) + "' placeholder='Item Discount' data-field='discount' />";
        html += "</td>";
        html += "<td>";
        html += "<input type='text' class='form-control allowOnlyDigit' name='itemsDiscountAmount" + rowNumber +
            "' value='" + displayViewAmountDigit(0) +
            "' placeholder='Item Discount' data-field='itemsDiscountAmount' disabled/>";
        html += "</td>";
        html += "<td>";
        html += "<input type='text' class='form-control allowOnlyDigit' name='itemsGSTPer" + rowNumber +
            "' value='" + displayViewAmountDigit(0) +
            "' placeholder='Item Discount' data-field='itemsGSTPer' disabled/>";
        html += "</td>";
        html += "<td>";
        html += "<input type='text' class='form-control allowOnlyDigit' name='itemsGSTAmount" + rowNumber +
            "' value='" + displayViewAmountDigit(0) +
            "' placeholder='Item Discount' data-field='itemsGSTAmount' disabled/>";
        html += "</td>";
        html += "<td>";
        html += "<input type='text' class='form-control' name='total" + rowNumber +
            "' value='" + displayViewAmountDigit(0) + "' placeholder='Item Total' disabled data-field='total'/>";
        html += "</td>";
        html +=
            "<td><button type='button' class='btn btn-sm btn-danger delete-item'><i class='fas fa-trash'></i></button> <button type='button' class='btn btn-sm btn-primary add-item'><i class='fas fa-plus'></i></button></td>";
        html += "</tr>";

        $('#itemTable tbody').append(html);
        $('.select2').select2();
        reassignInputIds();
        itemAmountCalculation();

    }

    $(document).on('change', '.itemId', function() {
        let itemId = $(this).val();
        let row = $(this).closest('tr'); // Get the row of the selected item

        if (itemId) {
            let selectedItem = itemList.find(item => item.id == itemId);
            let itemRate = parseFloat(selectedItem.mrp);
            let gstPercentage = parseFloat(selectedItem.basicSellingTax);
            let itemGSTAmount = 0;
            if (gstPercentage > 0) {
                itemGSTAmount = itemRate * gstPercentage / 100;
            }

            if (selectedItem) {
                // Set the values in the table fields based on the selected item
                row.find('[data-field="qty"]').val(displayViewAmountDigit(1));
                row.find('[data-field="rate"]').val(displayViewAmountDigit(selectedItem.basicSellingPrice));
                row.find('[data-field="discount"]').val(displayViewAmountDigit(0));
                row.find('[data-field="total"]').val(displayViewAmountDigit(1 * itemRate));
                row.find('[data-field="itemsGSTPer"]').val(displayViewAmountDigit(selectedItem
                    .basicSellingTax));
                row.find('[data-field="itemsGSTAmount"]').val(displayViewAmountDigit(itemGSTAmount));

                row.find('[data-field="hsn"]').text(selectedItem.hsnCode);
            }
        }
        // addNewItemRow();
        reassignInputIds();
        itemAmountCalculation()
    });





    // Add an event listener for changes in input fields
    $('#itemTable tbody').on('change', 'input', function() {
        itemAmountCalculation();
    });
    $('#state').on('change', function() {
        console.log("vnjskn")
        itemAmountCalculation();
    });

    // Handle item deletion
    $('#itemTable tbody').on('click', '.delete-item', function() {
        $(this).closest('tr').remove(); // Remove the row
        // Reassign input IDs and recalculate totals
        reassignInputIds();
        itemAmountCalculation();
    });
    $('#itemTable tbody').on('click', '.add-item', function() {
        addNewItemRow();
        reassignInputIds();
        itemAmountCalculation()
    });

    $('#gstType, #invoiceRoundOff').on('change', function() {
        itemAmountCalculation();
    });
    //
    function reassignInputIds() {
        // Loop through all table rows to reassign input IDs
        $('#itemTable tbody tr').each(function(index) {
            let row = $(this);
            row.find('[data-field="qty"]').attr('id', 'itemsQty' + (index + 1));
            row.find('[data-field="rate"]').attr('id', 'itemsRate_' + (index + 1));
            row.find('[data-field="discount"]').attr('id', 'itemsDiscount_' + (index + 1));
            row.find('[data-field="itemsDiscountAmount"]').attr('id', 'itemsDiscountAmount_' + (index + 1));
            row.find('[data-field="total"]').attr('id', 'total_' + (index + 1));
            // Optionally, you can also update the item ID input if needed
            row.find('[data-field="itemid"]').attr('id', 'itemsId_' + (index + 1));
        });
    }

    function itemAmountCalculation() {
        let totalInvoiceAmount = parseFloat(displayViewAmountDigit(0));
        let totalDiscountAmount = parseFloat(displayViewAmountDigit(0));
        let invoiceNetAmount = parseFloat(displayViewAmountDigit(0));
        let gstType = $("#gstType").val();
        let invoiceRoundOffAmount = displayViewAmountDigit($("#invoiceRoundOff").val());
        let invoiceGSTAmount = parseFloat(displayViewAmountDigit(0));

        let totalGSTAmount = parseFloat(displayViewAmountDigit(0));
        let state = $('#state').val()



        $('#itemTable tbody tr').each(function() {
            let row = $(this);
            let rate = parseFloat(row.find('[data-field="rate"]').val()) || 0;
            let qty = parseFloat(row.find('[data-field="qty"]').val()) || 0;
            let discount = parseFloat(row.find('[data-field="discount"]').val()) || 0;
            let total = (rate * qty);
            let gstPercentage = parseFloat(row.find('[data-field="itemsGSTPer"]').val()) || 0;
            let gstAmount = parseFloat(row.find('[data-field="itemsGSTAmount"]').val()) || 0;
            let discountAmount = parseFloat(displayViewAmountDigit(0));

            if (discount > 0) {
                discountAmount = total * discount / 100;
            }

            total = total - discountAmount;
            if (gstPercentage > 0) {
                gstAmount = total * gstPercentage / 100;
                totalGSTAmount = totalGSTAmount + gstAmount;
                total = total + gstAmount;
            }
            row.find('[data-field="itemsDiscountAmount"]').val(displayViewAmountDigit(discountAmount));
            row.find('[data-field="itemsGSTAmount"]').val(displayViewAmountDigit(gstAmount));
            row.find('[data-field="total"]').val(displayViewAmountDigit(total));

            totalInvoiceAmount = totalInvoiceAmount + total;
            totalDiscountAmount = totalDiscountAmount + discountAmount;
        });

        // calculation of Net Final Amount
        invoiceNetAmount = parseFloat(totalInvoiceAmount) + parseFloat(invoiceGSTAmount) + parseFloat(
            invoiceRoundOffAmount);

        $("#invoiceTotalAmount").val(displayViewAmountDigit(totalInvoiceAmount));
        $("#invoiceTotalDiscountAmount").val(displayViewAmountDigit(totalDiscountAmount));

        if (state !== '' && state === 'Gujarat') {
            $("#invoiceCGSTAmount").val(displayViewAmountDigit(totalGSTAmount / 2));
            $("#invoiceSGSTAmount").val(displayViewAmountDigit(totalGSTAmount / 2));
            $("#invoiceIGSTAmount").val(displayViewAmountDigit(0));
        } else if (state !== '' && state != 'Gujarat') {
            $("#invoiceIGSTAmount").val(displayViewAmountDigit(totalGSTAmount));
            $("#invoiceCGSTAmount").val(displayViewAmountDigit(0));
            $("#invoiceSGSTAmount").val(displayViewAmountDigit(0));
        } else {
            $("#invoiceIGSTAmount").val(displayViewAmountDigit(0));
            $("#invoiceCGSTAmount").val(displayViewAmountDigit(0));
            $("#invoiceSGSTAmount").val(displayViewAmountDigit(0));
        }

        $("#invoiceNetAmount").val(displayViewAmountDigit(invoiceNetAmount));
    }
    </script>
</body>

</html>