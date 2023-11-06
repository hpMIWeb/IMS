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
    <title>Vendor-List</title>
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
                            <h1>Vendor List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Vendor List</li>
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

                                <table id="vendorTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Vendor Name</th>
                                            <th>GST Number</th>
                                            <th>Contact Number</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>


                                </table>
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
        getVendorDetails();
        resetDataTable('vendorTable');
    });
    // Add a click event handler for the "Delete" buttons
    $('#vendorTable').on('click', '.delete-vendor', function(event) {
        event.preventDefault(); // Prevent the default link behavior

        const vendorId = $(this).data(
            'vendor-id'); // Get the item ID from the data attribute

        deleteVendor(vendorId);
    });


    function deleteVendor(vendorId) {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'deleteVendor',
            'vendorId': vendorId,
        };
        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {
                toast_success(response.message);
                getVendorDetails();
            } else {
                toast_error(response.message);
            }
        });
    }

    $('#vendorTable').on('click', '.edit-vendor', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        const vendorId = $(this).data(
            'vendor-id'); // Get the category ID from the data attribute
        window.location = "create-vendor.php?id=" +
            vendorId
    });

    function getVendorDetails() {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getVendorDetails',

        };
        APICallAjax(sendApiDataObj, function(response) {
            $("#vendorTable").dataTable().fnDestroy();
            $('#vendorTable tbody').html('');
            if (response.responseCode == RESULT_OK) {

                let html = '';
                let count = 1;

                $.each(response.result.vendorList, function(index, vendor) {
                    html += '<tr>';
                    html += '<td>' + count + '</td>';
                    html += '<td>' + vendor.vendorName + '</td>';
                    html += '<td>' + vendor.gstNo + '</td>';
                    html += '<td>' + vendor.contactNumber + '</td>';

                    html += '<td class="text-center-block py-0 align-middle">';
                    html += '<div class = "" > ';
                    html +=
                        ' <button  class="btn btn-warning btn-sm edit-vendor" data-vendor-id="' +
                        vendor.id + '">';
                    html += '<i class = "fas fa-pen" > </i>';
                    html += '</button>';
                    html +=
                        ' <button class="btn btn-danger btn-sm delete-vendor" data-vendor-id="' +
                        vendor.id + '">';
                    html += '<i class = "fas fa-trash" > </i>';
                    html += '</button>';
                    html += '</div>';
                    html += '</td > ';
                    html += '</tr>';
                    count++;

                });

                $('#vendorTable tbody').html(html);
                resetDataTable('vendorTable');
            } else {
                resetDataTable('vendorTable');
                toast_error(response.message);
            }
        });

    }
    </script>
</body>

</html>