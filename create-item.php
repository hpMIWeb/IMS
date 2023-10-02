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
    <title>create</title>
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
                            <h1>Item</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">item</li>
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
                        <form>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Item Name:</label>
                                            <input type="text" name="item_name" id="item_name" class="form-control" placeholder="Enter Item Name">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Item Code</label>
                                            <input type="text" name="item_code" id="item_code" class="form-control" placeholder="Enter Item Code">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <label>Item Quantity</label>
                                        <input type="text" name="item_qty" id="item_qty" class="form-control" placeholder="Enter Item qty">
                                        <!-- /.form-group -->
                                        <div class="form-group">

                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" name="item_desc" id="item_desc" class="form-control" placeholder="Description..">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Basic Price</label>
                                            <input type="text" name="basic_price " id="basic_price" class="form-control" placeholder="Enter Basic Price">
                                        </div>


                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>GST Rate</label>
                                            <input type="text" name="gst_rate" id="gst_rate" class="form-control" placeholder="Enter GST rate">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>MRP Item</label>
                                            <input type="text" name="mrp_item" id="mrp_item" class="form-control" placeholder="Enter MRP ">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <!-- /.col -->
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Rate</label>
                                            <input type="text" name="rate" id="rate" class="form-control" placeholder="Enter rate">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>

                                </div>
                                <div class="float-right">
                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                    <button type="submit" name="delete" class="btn btn-danger">Cancel</button>
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