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
    <title>Item Stock</title>
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
                            <h1>Item Stock</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Item Stock</li>
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
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Store:</label>
                                        <select name="stockType" id="stockType" class="form-control select2 stockType">
                                            <option value="">Select Store</option>
                                            <option value="live">LIVE Store</option>
                                            <option value="defective">Defective Store</option>
                                            <option value="company">Company Store</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table id="listItemTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10%;">Sr. No.</th>
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Item Qty</th>
                                                <th style="width: 10%;">Action</th>
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
        resetDataTable('listItemTable');
    });



    $(document).on('change', '#stockType', function() {
        if ($(this).val() === '') {
            toast_error("Please select valid stock type");
            $(this).focus();
            return false;
        }
        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getItemStock',
            'stockType': $(this).val(),

        };
        APICallAjax(sendApiDataObj, function(response) {
            $("#listItemTable").dataTable().fnDestroy();
            $('#listItemTable tbody').html('');
            if (response.responseCode == RESULT_OK) {

                let html = '';
                let count = 1;

                $.each(response.result.stockList, function(index, items) {
                    html += '<tr>';
                    html += '<td>' + count + '</td>';
                    html += '<td>' + items.itemCode + '</td>';
                    html += '<td>' + items.itemName + '</td>';
                    html += '<td>' + displayViewAmountDigit(items.itemStock) + '</td>';
                    html += '<td></td>';
                    html += '</tr>';
                    count++;

                });

                $('#listItemTable tbody').html(html);
                resetDataTable('listItemTable');
            } else {
                resetDataTable('listItemTable');
                toast_error(response.message);
            }
        });
    });
    </script>
</body>

</html>