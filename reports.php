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
    <title>Reports</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    include_once("include/commoncss.php");
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
                            <h1>Reports</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">reports</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="col-md-12 pt-3">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <!-- Date range -->
                                        <div class="row">
                                            <div class="col-6 form-group">
                                                <label>Reports</label>
                                                <select name="report" id="report" class="form-control select2" style="width: 100%;">
                                                    <option selected="selected"></option>
                                                    <option>Total stock report with value</option>
                                                    <option>User wise stock report with value</option>
                                                    <option>Item wise stock report where it is available</option>
                                                    <option>Defective stock report</option>
                                                    <option>Total sales by user (can be selected by period)</option>
                                                    <option>Item wise sales by user</option>
                                                    <option>Amc revenue by periode</option>
                                                    <option>Amc service due report</option>
                                                    <option>Amc expire report</option>
                                                    <option>Purchase report for gst purpose</option>
                                                    <option>Sales report for gst purpose</option>
                                                </select>
                                            </div>
                                            <div class="col-1  text-center mt-4 ">
                                                <div class="form-group">
                                                    <button type="button" name=" filter " onclick="filter()" class="btn btn-primary mt-2">Filter</button>
                                                </div>


                                            </div>

                                        </div>



                                    </div>
                                    <!-- /.card-body -->
                                    <!-- <div class="float-right">
                                            <button type="submit" name="submit" class="btn btn-primary">save</button>
                                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                        </div> -->
                                </div>
                            </div>
                            <div class="card-body">

                                <table id="itemTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-1">ID</th>
                                            <th>Name</th>
                                            <th>Qty</th>



                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>


                                </table>
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->

        <?php
        include_once("include/jquery.php");
        ?>
</body>
</html>
<script>
    function filter() {
        var id = 0;
        if ($("#itemTable tbody tr").length == 0) {
            id = 1;
        } else {
            id = $("#itemTable tbody tr").length + 1;
        }
        let html = "<tr>";
        html += "<td>" + id + "</td>";
        html += "<td><input type='text' class='form-group select 2' id='report' name='report' value='" + $("#report").val() + "' placeholder='' /></td>";
        html += "<td>jhkh</td>";
        html += "</tr>";
        $('#itemTable tbody').append(html)
    }
</script>
</body>
</html>