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
    <title>Amc-management</title>
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
                            <h1>Amc-management</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">amc-management</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card card-default">
                        <form>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <input type="text" name="customerName" id="customerName"
                                                class="form-control" placeholder="Enter customer name">
                                        </div>

                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" id="address" class="form-control"
                                                placeholder="Enter Address">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <label>Contact Number</label>
                                        <input type="text" name="contactNumber" id="contactNumber" class="form-control"
                                            placeholder="Enter contact number">

                                        <div class="form-group">

                                        </div>
                                        <div class="form-group">
                                            <label>Number Of Bathrooms</label>
                                            <input type="text" name="noOfBathroom" id="noOfBathroom"
                                                class="form-control" placeholder="Enter number of bathrooms">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Date range:</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control float-right" id="reservation">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="subscribeNews">No of service require during year : </label>

                                            <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">Alabama</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option>
                                            </select>

                                        </div>
                                    </div>


                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Amc Charrges</label>
                                            <input type="text" name="gst_rate" id="gst_rate" class="form-control"
                                                placeholder="Enter GST rate">
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Special Remarks</label>
                                            <input type="text" name="gst_rate" id="gst_rate" class="form-control"
                                                placeholder="Enter GST rate">
                                        </div>

                                    </div>





                                </div>

                            </div>
                            <div class="float-right">
                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                <button type="submit" name="delete" class="btn btn-danger">Cancel</button>
                            </div>
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
    //Initialize Select2 Elements
    $('.select2').select2()
    //Date range picker
    $('#reservation').daterangepicker()
    </script>
</body>

</html>