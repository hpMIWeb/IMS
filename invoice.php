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
    <title>Dashboard</title>
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
                            <h1>Invoice Bill</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">invoice</li>
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
                        <form method="POST" action="">

                            <!-- /.card-header -->
                            <div class="card-body">

                                <!-- /.row -->


                                <div class="row">
                                    <div class="col">
                                        <label>Client's Name/Company Name</label>
                                        <input type="text" name="client_name" class="form-control" placeholder="Enter Name or Company Name">

                                    </div>
                                    <div class="col">
                                        <label>GST No</label>
                                        <input type="text" name="client_gst" class="form-control" placeholder="Enter GST Number">

                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col">
                                        <label>Address</label>
                                        <textarea name="client_add" class="form-control" rows="2" placeholder="Enter Client's Address"></textarea>

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
                                            <label>Contact Number</label>
                                            <input type="text" name="client_num" class="form-control" placeholder="Enter Client's Contact Number">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label>Alternet Contact Number</label>
                                            <input type="text" name="client_altnum" class="form-control" placeholder="Enter Alternet Contact Number">
                                        </div>

                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <input type="text" name="disc" class="form-control" placeholder="discount">
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="client_email" id="client_email" class="form-control" placeholder="Enter Client's Email Id">
                                        </div>

                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Items</label>
                                            <select name=" item_name" id="items" class="form-control select2" style="width: 100%; ">
                                                <option selected="selected">Select Items</option>
                                                <option>Item 1</option>
                                                <option>Item 2</option>
                                                <option>Item 3</option>
                                                <option>Item 4</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Item Qty</label>
                                            <input type="number" name="item_qty" id="item_qty" class="form-control" placeholder="Enter Qty">
                                        </div>


                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Rate</label>
                                            <input type="number" name="item_rate" id="item_rate" class="form-control" placeholder="Enter rate">
                                        </div>


                                    </div>

                                    <div class="col-3 text-center mt-4 ">
                                        <div class="form-group">
                                            <button type="button" name=" add" class="btn btn-primary mt-2" onclick="add()">ADD</button>
                                        </div>


                                    </div>
                                    <div class="card-body">

                                        <table id="itemTable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">Id</th>
                                                    <th>Item Name</th>
                                                    <th>Item Qty</th>
                                                    <th>Rate</th>
                                                    <th>Total</th>
                                                    <th>Action</th>


                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>


                                        </table>
                                    </div>


                                </div>
                                <div class="">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" name="pdf_creater" class="btn btn-danger">PDF</button>
                                    <button type="submit" name="share" class="btn btn-success">Save & Share</button>
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
        function add() {

            var id = 0;
            if ($("#itemTable tbody tr").length == 0) {
                id = 1;
            } else {
                id = $("#itemTable tbody tr").length + 1;
            }
            let html = "<tr>";
            html += "<td>" + id + "</td>";

            html += "<td><input type='text' class='form-group select 2' id='items' name='items_name' value='" + $("#items").val() + "' placeholder='Select item' /></td>";
            html += "<td><input type='number' class='form-control' id='item_qty' name='items_qty' value='" + $("#item_qty").val() + "' placeholder='Select qty' /></td>";
            html += "<td><input type='number' class='form-control' id='item_qty' name='items_rate' value='" + $("#item_rate").val() + "' placeholder='Enter Rate' /></td>";
            html += "<td>Total</td>";
            html += "<td><button type=' button' class='fas fa-trash ' id='delete' value='' /></td>";
            html += "</tr>";


            $('#itemTable tbody').append(html)
        }
    </script>
</body>

</html>