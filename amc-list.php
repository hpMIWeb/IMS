<?php
session_start();
include_once './include/session-check.php';
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
                                        <th>Date of visit</th>
                                        <th>Work Details</th>
                                        <th>Customer Name</th>
                                        <th>Contact Number</th>
                                        <th>AMC Attend By</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Client 1</td>
                                        <td>1234</td>
                                        <td>1234567890</td>
                                        <td>1234567890</td>
                                        <td>1234567890</td>

                                        <td class="text-center-block py-0 align-middle">
                                            <div class="">
                                                <a href="#" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <a href="#" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>

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
        $("#amcTable").DataTable({
            "responsive": true,
            "autoWidth": false,
            ordering: false,
        });
    </script>
</body>

</html>