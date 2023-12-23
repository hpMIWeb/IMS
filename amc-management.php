<?php
include_once './include/session-check.php';
include_once './include/APICALL.php';
include_once './include/common-constat.php';

$amcMasterId = isset($_GET['id']) ? $_GET['id'] : 0
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AMC-management</title>
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
                            <h1>AMC Management</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">AMC Management</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card card-default">
                        <form>
                            <input type="hidden" id="action" value="add">
                            <input type="hidden" id="amcMasterId" value="<?php echo $amcMasterId; ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <input type="text" name="customerName" id="customerName"
                                                class="form-control" placeholder="Enter customer name">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" name="contactNumber" id="contactNumber"
                                                class="form-control allowOnlyDigit" placeholder="Enter contact number"
                                                maxlength="12">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Customer Card No.</label>
                                            <input type="text" name="customerCardNumber" id="customerCardNumber"
                                                class="form-control" placeholder="Enter customer card number">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Number Of Bathrooms</label>
                                            <input type="text" name="noOfBathroom" id="noOfBathroom"
                                                class="form-control allowOnlyDigit"
                                                placeholder="Enter number of bathrooms">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Date range:</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control float-right"
                                                    id="dateRangeSelector">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>No of service:</label>
                                            <select class="form-control select2" id="noOfService" name="noOfService">
                                                <option value="" disabled selected> Select Service No.</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>AMC Charges</label>
                                            <input type="text" name="amcCharges" id="amcCharges"
                                                class="form-control allowOnlyDigit" placeholder="Enter AMC Charges">
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" id="address" class="form-control"
                                                placeholder="Enter Address">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Special Remarks</label>
                                            <input type="text" name="remark" id="remark" class="form-control"
                                                placeholder="Enter Special Remarks">
                                        </div>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <button type="button" id="addUpdateAmcMasterBtn" name="submit"
                                        class="btn btn-primary">Save</button>
                                    <button type="button" name="cancelBtn" class="btn btn-danger"
                                        id="cancelBtn">Cancel</button>
                                </div>
                            </div>

                    </div>
                    </form>
                </div>
        </div>
        </section>
    </div>
    </div>
    <?php
include_once "include/footer.php";
?>
    <?php
include_once "include/jquery.php";
?>
    <script>
    //Initialize Select2 Elements
    $('.select2').select2()
    //Date range picker
    $('#dateRangeSelector').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY', // Set the desired date format here
            separator: ' / '
        }
    });
    $(document).ready(function() {
        fillNoOfServiceDropDown();
        let amcMasterId = $('#amcMasterId').val();
        if (amcMasterId !== '0') {
            getAmcData(amcMasterId)
        }

    });

    function fillNoOfServiceDropDown() {
        // Get a reference to the select element
        var select = $('#noOfService');

        // Loop to create options from 1 to 12
        for (var i = 1; i <= 12; i++) {
            var option = $('<option>', {
                value: i,
                text: i
            });

            // Append the option to the select element
            select.append(option);
        }
    }



    function getAmcData(amcMasterId) {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getAmcMasterDetails',
            'amcMasterId': amcMasterId,

        };
        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {

                $.each(response.result.amcMaster, function(index, amcMaster) {
                    $('#customerName').val(amcMaster.customerName);
                    $('#customerName').val(amcMaster.customerName);
                    $('#address').val(amcMaster.address);
                    $('#contactNumber').val(amcMaster.contactNumber);
                    $('#customerCardNumber').val(amcMaster.customerCardNumber);
                    $('#noOfBathroom').val(amcMaster.noOfBathroom);
                    $('#noOfService').val(amcMaster.noService).trigger('change');
                    $('#amcCharges').val(displayViewAmountDigit(amcMaster.amcCharges));
                    $('#remark').val(amcMaster.remark);
                    $('#action').val('edit');

                });
            } else {
                toast_error(response.message);
            }
        });
    }


    $('#addUpdateAmcMasterBtn').on('click', function(event) {
        let action = $('#action').val();
        let dateRangeArray = $('#dateRangeSelector').val().split("/");
        let startDate = dateRangeArray[0]
        let endDate = dateRangeArray[1]
        let amcMasterId = $('#amcMasterId').val();

        if ($('#customerName').val() === '') {
            toast_error("Please enter customer name.");
            $('#customerName').focus();
            return false;

        }
        if ($('#contactNumber').val() === '') {
            toast_error("Please enter contact number.");
            $('#contactNumber').focus();
            return false;

        }
        if ($('#noOfBathroom').val() === '') {
            toast_error("Please enter bathroom no.");
            $('#noOfBathroom').focus();
            return false;

        }
        if ($('#amcCharges').val() === '') {
            toast_error("Please enter AMC charges.");
            $('#amcCharges').focus();
            return false;

        }
        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'addUpdateAmcMaster',
            'amcMasterId': amcMasterId,
            'customerName': $('#customerName').val(),
            'address': $('#address').val(),
            'contactNumber': $('#contactNumber').val(),
            'customerCardNumber': $('#customerCardNumber').val(),
            'noOfBathroom': $('#noOfBathroom').val(),
            'startDate': startDate,
            'endDate': endDate,
            'noOfService': $('#noOfService').val(),
            'amcCharges': $('#amcCharges').val(),
            'remark': $('#remark').val(),
            'action': action,
        };
        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {
                toast_success(response.message);
                window.location = "amc-list.php";
            } else {
                toast_error(response.message);
            }
        });
    });
    $('#cancelBtn').on('click', function(event) {
        window.location = "amc-list.php";
    });
    </script>
</body>

</html>