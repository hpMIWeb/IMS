<?php
include_once './include/session-check.php';
include_once './include/APICALL.php';
include_once './include/common-constat.php';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AMC's List</title>
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
                            <h1>List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">AMC's list</li>
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
                                <div class="col-12">
                                    <div class="float-right">
                                        <a href="amc-management.php" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Add
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="amcTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Customer's Name</th>
                                        <th>Contact Number</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
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
            </section>
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
        $(document).ready(function() {
            getAmcList();
        });
        // Add a click event handler for the "Delete" buttons
        $('#amcTable').on('click', '.delete-category', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            const categoryId = $(this).data(
                'category-id'); // Get the category ID from the data attribute
            deleteCategory(categoryId);
        });


        function getAmcList() {

            let sendApiDataObj = {
                '<?php echo systemProject ?>': 'Masters',
                '<?php echo systemModuleFunction ?>': 'getAmcMasterDetails',

            };
            APICallAjax(sendApiDataObj, function(response) {
                if (response.responseCode == RESULT_OK) {

                    let html = '';
                    let count = 1;
                    $.each(response.result.amcMaster, function(index, amcMaster) {
                        html += '<tr>';
                        html += '<td>' + count + '</td>';
                        html += '<td>' + amcMaster.customerName + '</td>';
                        html += '<td>' + amcMaster.contactNumber + '</td>';
                        html += '<td>' + amcMaster.startDateDisplay + '</td>';
                        html += '<td>' + amcMaster.endDateDisplay + '</td>';


                        html += '<td class="text-center-block py-0 align-middle">';
                        html += '<div class = "" > ';
                        html +=
                            ' <a href="#"  class="btn btn-primary btn-sm c-amc-master" data-amcmaster-id="' +
                            amcMaster.id + '">';
                        html += '<i class = "fas fa-eye" > </i>';
                        html += '</a>';
                        html +=
                            ' <a href="#"  class="btn btn-warning btn-sm edit-amc-master" data-amcmaster-id="' +
                            amcMaster.id + '">';
                        html += '<i class = "fas fa-pen" > </i>';
                        html += '</a>';
                        html +=
                            ' <a href="#" class="btn btn-danger btn-sm delete-amc-master" data-amcmaster-id="' +
                            amcMaster.id + '">';
                        html += '<i class = "fas fa-trash" > </i>';
                        html += '</a>';
                        html += '</div>';
                        html += '</td > ';
                        html += '</tr>';
                        count++;

                    });
                    $('#amcTable tbody').html(html);
                } else {
                    toast_error(response.message);
                }
            });
        }
        $("#amcTable").DataTable({
            "responsive": true,
            "autoWidth": false,
            ordering: false,
        });
    </script>
</body>

</html>