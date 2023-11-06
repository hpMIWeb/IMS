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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name:</label>
                                            <input type="text" name="vendorName" id="vendorName" class="form-control"
                                                placeholder="Enter Name:">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Contact</label>
                                            <input type="text" name="contactNumber" id="contactNumber"
                                                class="form-control" placeholder="Enter Contact Number">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="contactEmail" id="contactEmail"
                                                class="form-control" placeholder="Enter Contact Email">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>GST No</label>
                                            <input type="text" name="gstNo" id="gstNo" class="form-control"
                                                placeholder="Enter GST No">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Billing Address</label>
                                            <textarea name="address" class="form-control" rows="2"
                                                placeholder="Enter Address:"></textarea>
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
                                            <textarea name="address" class="form-control" rows="2"
                                                placeholder="Enter Address:"></textarea>
                                        </div>
                                    </div>

                                </div>


                                <div class="float-right">
                                    <button type="button" name="submit" class="btn btn-primary">Save</button>
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
</body>

</html>