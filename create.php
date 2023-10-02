<?php
session_start();



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
                            <h1>Create</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">create</li>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Vendor's Name:</label>
                                            <input type="text" name="vendor's_name" id="vendor's_name"
                                                class="form-control" placeholder="Enter Name:">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Vendor's GST No</label>
                                            <input type="text" name="vendor's_GSTNo" id="vendor's_GSTNo"
                                                class="form-control" placeholder="Enter GST No:">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">

                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>State:</label>
                                            <select name="state" class="form-control select2" style="width: 100%;">
                                                <option selected="selected"></option>
                                                <option>Gujarat</option>
                                                <option>Maharastra</option>
                                                <option>Kerala</option>
                                                <option>Punjab</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" class="form-control" rows="2"
                                                placeholder="Enter Address:"></textarea>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label> Contact Number</label>
                                            <input type="text" name="contact " class="form-control"
                                                placeholder="Enter Contact Number">
                                        </div>


                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Alternate Contact Number(if Any):</label>
                                            <input type="text" name="alt_contact" class="form-control"
                                                placeholder="Enter Alternate Contact Number:">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" class="form-control"
                                                placeholder="Enter Email">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                                <div class="">
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