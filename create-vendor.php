<?php
include_once './include/session-check.php';
include_once './include/common-constat.php';
include_once './include/APICALL.php';
$vendorId = isset($_GET['id']) ? $_GET['id'] : 0
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create Vendor</title>
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
                            <h1>Create Vendor</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Create Vendor</li>
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
                        <form action="generate-pdf.php" method="POST">

                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="vendorId" id="vendorId" value="<?php echo $vendorId; ?>">
                                    <input type="hidden" name="action" id="action" value="add">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name:</label>
                                            <input type="text" name="vendorName" id="vendorName" class="form-control"
                                                placeholder="Enter Name:">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="contactEmail" id="contactEmail"
                                                class="form-control" placeholder="Enter Contact Email">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>GST No</label>
                                            <input type="text" name="gstNo" id="gstNo" class="form-control"
                                                placeholder="Enter GST No">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact Name</label>
                                            <input type="text" name="contactName" id="contactName" class="form-control"
                                                placeholder="Enter Contact Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ContactNumber </label>
                                            <input type="text" name="contactNumber" id="contactNumber"
                                                class="form-control" placeholder="Enter Contact Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Billing Address</label>
                                            <textarea name="billingAddress" id="billingAddress" class="form-control"
                                                rows="2" placeholder="Enter Address:"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-2 mt-5 text-center">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">Same as Billing</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Shipping Address</label>
                                            <textarea name="shippingAddress" id="shippingAddress"
                                                class="form-control shippingAddress" rows="2"
                                                placeholder="Enter Address:"></textarea>
                                        </div>
                                    </div>

                                </div>


                                <div class="float-right">
                                    <button type="button" name="submit" id="addUpdateVendorBtn"
                                        class="btn btn-primary">Save</button>
                                    <button type="button" name="delete" class="btn btn-danger">Cancel</button>
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
        let vendorId = $('#vendorId').val();
        if (vendorId !== '0') {
            getVendorDetails(vendorId)
        }

    });

    function getVendorDetails(vendorId) {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getVendorDetails',
            'vendorId': vendorId
        };
        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {

                $.each(response.result.vendorList, function(index, vendor) {
                    $('#action').val('edit');
                    $('#vendorName').val(vendor.vendorName);
                    $('#contactNumber').val(vendor.contactNumber);
                    $('#contactName').val(vendor.contactName);
                    $('#contactEmail').val(vendor.email);
                    $('#gstNo').val(vendor.gstNo);
                    $('#billingAddress').val(vendor.billingAddress);
                    $('#shippingAddress').val(vendor.shippingAddress);

                });
            } else {
                toast_error(response.message);
            }
        });
    }

    $('#addUpdateVendorBtn').on('click', function(event) {
        let vendorName = $('#vendorName').val();
        let action = $('#action').val();
        let vendorId = $('#vendorId').val();
        let contactNumber = $('#contactNumber').val();
        let contactName = $('#contactName').val();
        let contactEmail = $('#contactEmail').val();
        let gstNo = $('#gstNo').val();
        let billingAddress = $('#billingAddress').val();
        let shippingAddress = $('#shippingAddress').val();

        if (vendorName === '') {
            toast_error("Please enter name.");
            $('#vendorName').focus();
            return false;
        }


        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'addUpdateVendor',
            'vendorId': vendorId,
            'action': action,
            'vendorName': vendorName,
            'contactNumber': contactNumber,
            'contactName': contactName,
            'contactEmail': contactEmail,
            'gstNo': gstNo,
            'billingAddress': billingAddress,
            'shippingAddress': shippingAddress,
        };

        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {
                toast_success(response.message);
                window.location = "vendor-list.php";
                resetFormFields()
            } else {
                toast_error(response.message);
            }
        });
    });
    </script>
</body>

</html>