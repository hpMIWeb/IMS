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
    <title>Invoice List</title>
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
                            <h1>Invoice List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Invoice List</li>
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
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <div class="float-right">
                                        <a href="invoice.php" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Add
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table id="invoiceTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10%;">Sr. No.</th>
                                                <th>Bill No.</th>
                                                <th>Invoice Date</th>
                                                <th>Client Name</th>
                                                <th>Contact Number</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

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
        getInvoiceDetails();
        resetDataTable('invoiceTable');
    });


    function getInvoiceDetails() {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getInvoiceDetails',

        };
        APICallAjax(sendApiDataObj, function(response) {
            $("#invoiceTable").dataTable().fnDestroy();
            $('#invoiceTable tbody').html('');
            if (response.responseCode == RESULT_OK) {

                let html = '';
                let count = 1;

                $.each(response.result.invoiceList, function(index, invoice) {
                    html += '<tr>';
                    html += '<td>' + count + '</td>';
                    html += '<td>' + invoice.billNo + '</td>';
                    html += '<td>' + invoice.startDateDisplay + '</td>';
                    html += '<td>' + invoice.clientName + '</td>';
                    html += '<td>' + invoice.contactNumber + '</td>';
                    html += '<td>' + displayIndianRupeeCurrency(invoice.netAmount) + '</td>';
                    html +=
                        '<td><a href="invoice-print.php"><i class="fa fa-file-pdf"></i></a></td>';
                    html += '</tr>';
                    count++;

                });

                $('#invoiceTable tbody').html(html);
                resetDataTable('invoiceTable');
            } else {
                resetDataTable('invoiceTable');
                toast_error(response.message);
            }
        });

    }
    // Function to reset form fields
    function resetFormFields() {
        $('#itemName').val('');
        $('#minimumStockLevel').val('');
        $('#mrp').val('');
        $('#action').val('add');
    }
    </script>
</body>

</html>