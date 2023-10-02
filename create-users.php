<?php
session_start();
ob_start();
    include_once './include/session-check.php';
    include_once './include/common-constat.php';



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User-Create</title>
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
                            <h1>Users</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">user</li>
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

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">

                                        <!-- /.form-group -->

                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">

                                    <!-- /.col -->

                                    <!-- /.col -->

                                </div>


                                <div class="row">
                                    <div class="col">
                                        <label> First Name</label>
                                        <input type="text" name="fname" id="lname" class=" form-control" placeholder="Enter First Name">



                                    </div>
                                    <div class="col">
                                        <label>Last Name</label>
                                        <input type="text" name="lname" id=" lname" class="form-control" placeholder="Enter Last Name">
                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col">
                                        <label> Address</label>
                                        <textarea name="user_add" id="user_add" class="form-control" rows="2" placeholder="Address.."></textarea>

                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>State:</label>
                                            <select name=" client_state" class="form-control select2" style="width: 100%; ">
                                                <option selected="selected"></option>
                                                <option>Gujarat</option>
                                                <option>Maharastra</option>
                                                <option>Kerala</option>
                                                <option>Punjab</option>
                                            </select>

                                        </div>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label>Client's Email Id</label>
                                            <input type="text" name="client_email" id="client_email" class="form-control" placeholder="Enter Client's Email Id">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label>Client's Contact Number</label>
                                            <input type="text" name="client_num" id="client_num" class="form-control" placeholder="Enter Client's Contact Number">
                                        </div>

                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" name="pass" id="pass" class="form-control" placeholder="Enter Password">
                                        </div>

                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="text" name="cpass" id="cpass" class="form-control" placeholder="Enter Confirm Password">
                                        </div>

                                        <!-- /.form-group -->
                                    </div>

                                </div>
                                <div class="float-right">
                                    <button type="submit" name="submit" class="btn btn-primary">save</button>
                                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
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