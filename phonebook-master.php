<?php
include_once './include/session-check.php';
include_once './include/APICALL.php';
include_once './include/common-constat.php';
$phoneBookMasterId = isset($_GET['id']) ? $_GET['id'] : 0
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>phonebook-Master</title>
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
                            <h1>Phone Book Master</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Phone Book Master</li>
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
                            <!-- <div class="card-header">
              <h3 class="card-title">DataTable with minimal features & hover style</h3>
            </div> -->
                            <!-- /.card-header -->
                            <div class="col-md-12 pt-3">
                                <div class="card card-primary">

                                    <div class="card-body">
                                        <!-- Date range -->
                                        <div class="row">
                                            <input type="hidden" name="phoneBookMasterId" id="phoneBookMasterId"
                                                value="<?php echo $phoneBookMasterId; ?>">
                                            <input type="hidden" name="action" id="action" value="add">
                                            <div class="col-4 form-group">
                                                <label>Category</label>
                                                <select name="category" id="category" class="form-control select2"
                                                    style="width: 100%; ">
                                                    <option selected="selected"></option>

                                                </select>
                                            </div>
                                            <div class="col-4 form-group">

                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" name="address" id="address" class="form-control"
                                                        placeholder="Enter Address">
                                                </div>
                                            </div>
                                            <div class="col-4 form-group">
                                                <label>Name</label>
                                                <input type="text" name="categoryName" id="categoryName"
                                                    class="form-control" placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="row">


                                            <div class="col-4 form-group">

                                                <div class="form-group">
                                                    <label>Designation</label>
                                                    <input type="text" name="designation" id="designation"
                                                        class="form-control" placeholder="designation">
                                                </div>
                                            </div>
                                            <div class="col-4 form-group">
                                                <label>Company Name</label>
                                                <input type="text" name="companyName" id="companyName"
                                                    class="form-control" placeholder="Enter company Name">
                                            </div>
                                            <div class="col-4 form-group">

                                                <div class="form-group">
                                                    <label>Remark</label>
                                                    <input type="text" name="remark" id="remark" class="form-control"
                                                        placeholder="Remark">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 form-group">
                                                <label>Contact Number</label>
                                                <input type="text" name="contactNumber" id="contactNumber"
                                                    class="form-control" placeholder="Enter Contact Number">
                                            </div>
                                            <div class="col-4 form-group"></div>
                                            <div class="col-4 form-group ">
                                                <div class="float-right" style="margin-top: 25px;">
                                                    <button type="button" id="addUpdatePhoneBookMasterBtn" name="submit"
                                                        class="btn btn-primary">Save</button>
                                                    <button type="button" name="delete" class="btn btn-danger"
                                                        onclick="resetFormFields()">Cancel</button>
                                                </div>
                                            </div>

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

                        <script>
                        $('.select2').select2()

                        $(document).ready(function() {
                            getCategory();
                            if ($('#phoneBookMasterId').val() != 0) {
                                getPhoneBookMaster();
                            }
                        });

                        function getCategory() {

                            let sendApiDataObj = {
                                '<?php echo systemProject ?>': 'Masters',
                                '<?php echo systemModuleFunction ?>': 'getCategoryMasterDetails',

                            };
                            APICallAjax(sendApiDataObj, function(response) {
                                if (response.responseCode == RESULT_OK) {

                                    let html = '<option value="">Select Category</option>';

                                    $.each(response.result.category, function(index, category) {
                                        html += '<option value = "' + category.id + '" > ' + category
                                            .name +
                                            ' </option>';

                                    });
                                    $('#category').html(html);


                                } else {
                                    toast_error(response.message);
                                }
                            });
                        }



                        function getPhoneBookMaster() {

                            let sendApiDataObj = {
                                '<?php echo systemProject ?>': 'Masters',
                                '<?php echo systemModuleFunction ?>': 'getPhoneBookMasterDetails',
                                'phoneBookMasterId': $('#phoneBookMasterId').val(),

                            };
                            APICallAjax(sendApiDataObj, function(response) {
                                if (response.responseCode == RESULT_OK) {
                                    $.each(response.result.phoneBookMaster, function(index,
                                        phoneBookMaster) {

                                        $('#action').val("edit");
                                        $('#category').val(phoneBookMaster.category).trigger(
                                            'change');
                                        $('#categoryName').val(phoneBookMaster.name);
                                        $('#contactNumber').val(phoneBookMaster.contactNumber);
                                        $('#address').val(phoneBookMaster.address);
                                        $('#designation').val(phoneBookMaster.designation);
                                        $('#companyName').val(phoneBookMaster.companyName);
                                        $('#remark').val(phoneBookMaster.remark);
                                    });

                                } else {
                                    toast_error(response.message);
                                }
                            });
                        }


                        $('#addUpdatePhoneBookMasterBtn').on('click', function(event) {

                            let category = $('#category').val();
                            let name = $('#categoryName').val();
                            let address = $('#address').val();
                            let action = $('#action').val();
                            let contactNumber = $('#contactNumber').val();
                            let designation = $('#designation').val();
                            let companyName = $('#companyName').val();
                            let remark = $('#remark').val();
                            let phoneBookMasterId = $('#phoneBookMasterId').val();


                            let sendApiDataObj = {
                                '<?php echo systemProject ?>': 'Masters',
                                '<?php echo systemModuleFunction ?>': 'addUpdatePhoneBookMaster',
                                'phoneBookMasterId': phoneBookMasterId,
                                'name': name,
                                'address': address,
                                'contactNumber': contactNumber,
                                'designation': designation,
                                'companyName': companyName,
                                'remark': remark,
                                'action': action,
                                'category': category
                            };

                            console.log(sendApiDataObj)

                            APICallAjax(sendApiDataObj, function(response) {
                                if (response.responseCode == RESULT_OK) {
                                    toast_success(response.message);
                                    window.location = "phonebook-master-list.php";
                                    resetFormFields()
                                } else {
                                    toast_error(response.message);
                                }
                            });
                        });



                        // Function to reset form fields
                        function resetFormFields() {
                            $('#category').val('');
                            $('#categoryName').val('');
                            $('#address').val('');
                            $('#contactNumber').val('');
                            $('#designation').val('');
                            $('#companyName').val('');
                            $('#remark').val('');
                            $('#action').val('add');
                            $('#phoneBookMasterId').val();
                        }
                        </script>
</body>

</html>