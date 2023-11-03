<?php
session_start();
include_once './include/session-check.php';
include_once './include/APICALL.php';
include_once './include/common-constat.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice</title>
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
                            <h1>Invoice</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Invoice</li>
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
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-9">

                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Bill No</label>
                                            <input type="text" name="billNo" class="form-control"
                                                placeholder="Enter GST Number" value="B-123">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Client's Name/Company Name</label>
                                            <input type="text" name="client_name" class="form-control"
                                                placeholder="Enter Name or Company Name">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" name="client_num" class="form-control"
                                                placeholder="Enter Client's Contact Number">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="client_email" id="client_email"
                                                class="form-control" placeholder="Enter Client's Email Id">
                                        </div>

                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>GST No</label>
                                            <input type="text" name="client_gst" class="form-control"
                                                placeholder="Enter GST Number">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="client_add" class="form-control" rows="2"
                                                placeholder="Enter Client's Address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>State:</label>
                                            <select name=" client_state" class="form-control select2"
                                                style="width: 100%; ">
                                                <option selected="selected"></option>
                                                <option>Gujarat</option>
                                                <option>Maharastra</option>
                                                <option>Kerala</option>
                                                <option>Punjab</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Item:</label>
                                            <select name="itemId" id="itemId" class="form-control select2 itemId"
                                                style="width: 100%; ">

                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-3 mt-4">
                                        <div class="form-group">
                                            <button type="button" name=" add" class="btn btn-primary mt-2"
                                                onclick="add()">ADD ITEM</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table id="itemTable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%;">Id</th>
                                                    <th style="width: 30%;">Item Name</th>
                                                    <th style="width: 5%;">Item Qty</th>
                                                    <th style="width: 10%;">Rate</th>
                                                    <th style="width: 10%;">Discount</th>
                                                    <th style="width: 10%;">Total</th>
                                                    <th style="width: 5%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>


                                        </table>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-9"></div>
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Total:</label>
                                                    <input type="text" name="client_email" id="client_email"
                                                        class="form-control" placeholder="Total amount" disabled>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Total Discount:</label>
                                                    <input type="text" name="client_email" id="client_email"
                                                        class="form-control" placeholder="Discount" disabled>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Apply GST:</label>
                                                    <select name=" client_state" class="form-control select2"
                                                        style="width: 100%;" placeholder="Discount">
                                                        <option>Not Apply</option>
                                                        <option>Apply GST</option>
                                                        <option>Apply IGST</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>GST Amount:</label>
                                                    <input type="text" name="client_email" id="client_email"
                                                        class="form-control" placeholder="GST" disabled>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Round off:</label>
                                                    <input type="text" name="client_email" id="client_email"
                                                        class="form-control" placeholder="Round off" disabled>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Net amount:</label>
                                                    <input type="text" name="client_email" id="client_email"
                                                        class="form-control" placeholder="Round off" disabled>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <button type="submit" name="submit" class="btn btn-primary">
                                            Save</button>
                                        <button type="submit" name="share" class="btn btn-danger">Cancel</button>
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
    $(document).ready(function() {
        getItemDetails();
    });

    function getItemDetails() {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Masters',
            '<?php echo systemModuleFunction ?>': 'getItemDetails',

        };
        APICallAjax(sendApiDataObj, function(response) {

            if (response.responseCode == RESULT_OK) {

                let html = '<option selected="selected">Select Item</option>';

                $.each(response.result.itemList, function(index, items) {
                    html += '<option value="' + items.id + '">' + items.itemName + '</option>';

                });

                $('#itemId').html(html)
            }
        });

    }



    function add() {

        var srNo = $("#itemTable tbody tr").length + 1;

        let html = "<tr>";
        html += "<td>" + srNo + "</td>";
        html += "<td>ITem name</td>";
        html += "<td>";
        html += "<input type='text' class='form-control' id='itemsQty" + srNo +
            "'  value = '1' placeholder='Qty' />"
        html += "<input type='hidden' id='itemsId_" + srNo + "'/>";
        html += "</td>";

        html += "<td>";
        html += "<input type='text' class='form-control' id='itemsRate_" + srNo +
            "' value = '1' placeholder = 'Rate' />";
        html += "</td>";

        html += "<td>";
        html += "<input type='text' class='form-control' id='itemsDiscount_" + srNo +
            "' value = '1' placeholder = 'items Discount' />";
        html += "</td>";
        html += "<td>";
        html += "<input type='text' class='form-control' id='total_" + srNo +
            "' value = '1' placeholder = 'items Discount' disabled />";
        html += "</td>";

        html +=
            "<td><button type='button' class='btn btn-sm' id='delete' value='' ><i class='fas fa-trash'></i></button></td>";
        html += "</tr>";


        $('#itemTable tbody').append(html)
    }
    </script>
</body>

</html>