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
    <title>items allocate</title>
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
                            <h1>Items-Allocate</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">item-allocate</li>
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

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <select name=" item_name" id="items" class="form-control select2" style="width: 100%; ">
                                                <option selected="selected">Select username </option>
                                                <option>user 1</option>
                                                <option>user 2</option>
                                                <option>user 3</option>
                                                <option>user 4</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Item Name</label>
                                            <select name="item_qty" id="itemsqty" class="form-control select2" style="width: 100%; ">
                                                <option selected="selected">Select Item</option>
                                                <option>Item 1</option>
                                                <option>Item 2</option>
                                                <option>Item 3</option>
                                                <option>Item 4</option>
                                            </select>
                                        </div>


                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Item Qty</label>
                                            <input type="text" name="item_qty" value="1" disabled class="form-control" placeholder="Enter Qty">
                                        </div>


                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Total</label>
                                            <input type="text" name="item_qty" class="form-control" placeholder="Total">
                                        </div>


                                    </div>

                                    <div class="col-1  text-center mt-4 ">
                                        <div class="form-group">
                                            <button type="button" name=" assign " class="btn btn-primary mt-2" >Assign</button>
                                        </div>


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
        function add() {


            let html = "<tr>"
            html += "<td>jbjk</td>"

            html += "<input type='text' class='form-group select 2' id='items' name='items_name' value='' placeholder='Select item' />"
            html += "<input type='text' class='form-group select 2' id='itemsqty' name='items_qty' value='' placeholder='Select qty' />"
            html += "<td>jbjkb</td>"
            html += "</tr>"

            $('#itemTable tbody').append(html)

        }
    </script>
</body>

</html>