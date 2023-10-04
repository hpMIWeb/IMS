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
    <title>Amc-management</title>
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
                            <h1>Amc-management</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">amc-management</li>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <input type="text" name="customerName" id="customerName" class="form-control" placeholder="Enter customer name">
                                        </div>

                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" name="contactNumber" id="contactNumber" class="form-control" placeholder="Enter contact number">
                                        </div>

                                        <div class="form-group">
                                            <label>Number Of Bathrooms</label>
                                            <input type="text" name="noOfBathroom" id="noOfBathroom" class="form-control" placeholder="Enter number of bathrooms">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Date range:</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control float-right" id="dateRangeSelector">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="subscribeNews">No of service require during year : </label>
                                            <select class="form-control select2" id="noOfService" name="noOfService">
                                                <option value="1">1 </option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>

                                            </select>

                                        </div>
                                    </div>


                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Amc Charges</label>
                                            <input type="text" name="amcCharges" id="amcCharges" class="form-control" placeholder="Enter GST rate">
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Special Remarks</label>
                                            <input type="text" name="remark" id="remark" class="form-control" placeholder="Enter GST rate">
                                        </div>

                                    </div>
                                </div>
                                <div class="float-right">
                                    <button type="button" id="addUpdateAmcMasterBtn" name="submit" class="btn btn-primary">Save</button>
                                    <button type="button" name="cancelBtn" class="btn btn-danger" id="cancelBtn">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php
    include_once("include/footer.php");
    ?>
    <?php
    include_once("include/jquery.php");
    ?>
    <script>
        $(document).ready(function() {
            let amcMasterId = $('#amcMasterId').val();
            if (amcMasterId !== '0') {
                getAmcData(amcMasterId)
            }

        });

        function getAmcData(amcMasterId) {

            let sendApiDataObj = {
                '<?php echo systemProject ?>': 'Masters',
                '<?php echo systemModuleFunction ?>': 'getAmcMasterDetails',
                'amcMasterId': amcMasterId,

            };
            APICallAjax(sendApiDataObj, function(response) {
                if (response.responseCode == RESULT_OK) {

                    $.each(response.result.amcMaster, function(index, amcMaster) {
                        console.log(amcMaster.noOfService)
                        $('#customerName').val(amcMaster.customerName);
                        $('#customerName').val(amcMaster.customerName);
                        $('#address').val(amcMaster.address);
                        $('#contactNumber').val(amcMaster.contactNumber);
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
        //Initialize Select2 Elements
        $('.select2').select2()
        //Date range picker
        $('#dateRangeSelector').daterangepicker();

        $('#addUpdateAmcMasterBtn').on('click', function(event) {
            let action = $('#action').val();
            let dateRangeArray = $('#dateRangeSelector').val().split("-");
            let startDate = dateRangeArray[0]
            let endDate = dateRangeArray[1]
            let amcMasterId = $('#amcMasterId').val();
            let sendApiDataObj = {
                '<?php echo systemProject ?>': 'Masters',
                '<?php echo systemModuleFunction ?>': 'addUpdateAmcMaster',
                'amcMasterId': amcMasterId,
                'customerName': $('#customerName').val(),
                'address': $('#address').val(),
                'contactNumber': $('#contactNumber').val(),
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