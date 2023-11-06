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
    <title>AMC's Customer List</title>
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
                            <h1>Customer AMC List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Customer AMC List</li>
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
                        <!-- /.card-header -->
                        <div class="card-header">
                            <div class="row">

                                <div class="col-9">
                                    <table class="table">
                                        <tr>
                                            <td><strong>Name :- </strong></td>
                                            <td><span id="clientName"></td>
                                            <td><strong>Contact :- </strong></td>
                                            <td><span id="contact"></td>
                                            <td><strong>No Service :- </strong></td>
                                            <td><span id="noOfService"></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Start Date:- </strong></td>
                                            <td><span id="startDate"></td>
                                            <td><strong>End Date:- </strong></td>
                                            <td><span id="endDate"></td>
                                            <td><strong>AMC Charges :- </strong></td>
                                            <td><span id="amcCharges"></td>
                                        </tr>
                                    </table>

                                </div>
                                <div class="col-3">
                                    <div class="float-right mt-5">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#amcModal">
                                            <i class="fas fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table id="amcTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Date Of Visit</th>
                                                <th>Work Detail</th>
                                                <th>Customer Name</th>
                                                <th>Contact No.</th>
                                                <th>AMC Attended By</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </section>
        </div>


        <div class="modal fade" id="amcModal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Customer Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="hidden" id="action" value="add">
                            <input type="hidden" id="amcMasterId" value="<?php echo $amcMasterId; ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <input type="text" name="customerName" id="customerName"
                                                class="form-control" placeholder="Enter customer name">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" name="contactNumber" id="contactNumber"
                                                class="form-control" placeholder="Enter contact number">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Date:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control float-right"
                                                    value="<?php echo date('d/m/Y'); ?>" id="visitDate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>AMC Attend By</label>
                                            <input type="text" name="attendBy" id="attendBy" class="form-control"
                                                placeholder="Enter Attend By">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Work Details</label>
                                            <textarea name="workDetails" id="workDetails" class="form-control"
                                                placeholder="Enter Work Details"></textarea>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="amcDetailsBtn">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div><!-- /.container-fluid -->
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
    let amcDoneCount = 0;
    $(document).ready(function() {
        resetDataTable('amcTable');
        let amcMasterId = $('#amcMasterId').val();
        getAmcDetailsList(amcMasterId);
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
                    $('#clientName').html(amcMaster.customerName);
                    $('#contact').html(amcMaster.contactNumber);
                    $('#noOfService').html(amcDoneCount + "/" + amcMaster.noService);
                    $('#amcCharges').html(displayIndianRupeeCurrency(amcMaster.amcCharges));
                    $('#startDate').html(amcMaster.startDateDisplay);
                    $('#endDate').html(amcMaster.endDateDisplay);
                    $('#customerName').val(amcMaster.customerName);
                    $('#contactNumber').val(amcMaster.contactNumber);
                });
            } else {
                toast_error(response.message);
            }
        });
    }

    $('#amcDetailsBtn').on('click', function(event) {
        let action = $('#action').val();
        let amcMasterId = $('#amcMasterId').val();
        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'addUpdateAmcDetails',
            'amcMasterId': amcMasterId,
            'customerName': $('#customerName').val(),
            'workDetails': $('#workDetails').val(),
            'attendBy': $('#attendBy').val(),
            'contactNumber': $('#contactNumber').val(),
            'visitDate': $('#visitDate').val(),
            'action': action,
        };
        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {
                toast_success(response.message);
                getAmcData(amcMasterId);
                getAmcDetailsList(amcMasterId);
                $('#amcModal').modal('hide');
                resetFormFields();
            } else {
                toast_error(response.message);
            }
        });
    });

    function getAmcDetailsList(amcMasterId) {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getAmcDetails',
            'amcMasterId': amcMasterId,

        };
        APICallAjax(sendApiDataObj, function(response) {
            $("#amcTable").dataTable().fnDestroy();
            $('#amcTable tbody').html('');
            if (response.responseCode == RESULT_OK) {

                let html = '';
                let count = 1;
                $.each(response.result.amcDetails, function(index, amcDetails) {
                    html += '<tr>';
                    html += '<td>' + count + '</td>';
                    html += '<td>' + amcDetails.visitDateDisplay + '</td>';
                    html += '<td>' + amcDetails.workDetails + '</td>';
                    html += '<td>' + amcDetails.customerName + '</td>';
                    html += '<td>' + amcDetails.contactNumber + '</td>';
                    html += '<td>' + amcDetails.attendBy + '</td>';

                    html += '</tr>';
                    amcDoneCount = count;
                    count++;

                });
                $('#amcTable tbody').html(html);
                resetDataTable('amcTable');
            } else {
                resetDataTable('amcTable');
                toast_error(response.message);
            }
        });
    }

    // Function to reset form fields
    function resetFormFields() {

        $('#action').val('add');
        $('#customerName').val('');
        $('#workDetails').val('');
        $('#contactNumber').val('');
    }
    </script>
</body>

</html>