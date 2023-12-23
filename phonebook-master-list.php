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
    <title>phone Book Master List</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
include_once "include/commoncss.php";
?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php
include_once "include/header.php";
include_once "include/sidebar.php";

?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Phone Book Master List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Phone Book Master List</li>
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
                                <div class="card card-default">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="float-right">
                                                    <a href="phonebookExcel.php" class="btn btn-primary">
                                                        <i class="fas fa-file-excel"></i> Export
                                                    </a> <a href="phonebook-master.php" class="btn btn-primary">
                                                        <i class="fas fa-plus"></i> Add
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <div class="row">
                                                <div class="col-4 form-group">
                                                    <label>Category</label>
                                                    <select class="form-control select2" style="width: 100%;"
                                                        id="categoryId">
                                                        <option value="">All Category</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-12">
                                                    <table id="phoneBookMasterTable"
                                                        class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr.No.</th>
                                                                <th>Name</th>
                                                                <th>Address</th>
                                                                <th>Contact Number</th>
                                                                <th>Designation</th>
                                                                <th>Company Name</th>
                                                                <th>Remark</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
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

include_once "include/jquery.php";

?>

                        <script>
                        $('.select2').select2()

                        resetDataTable('phoneBookMasterTable');

                        $(document).ready(function() {
                            getPhoneBookMaster();
                            getCategory();
                        });

                        function getCategory() {

                            let sendApiDataObj = {
                                '<?php echo systemProject ?>': 'Masters',
                                '<?php echo systemModuleFunction ?>': 'getCategoryMasterDetails',

                            };
                            APICallAjax(sendApiDataObj, function(response) {
                                if (response.responseCode == RESULT_OK) {

                                    let htmlForListDropDown = '<option value="">All Category</option>';

                                    $.each(response.result.category, function(index, category) {

                                        htmlForListDropDown += '<option value = "' + category.id +
                                            '" > ' +
                                            category.name +
                                            ' </option>';
                                    });

                                    $('#categoryId').html(htmlForListDropDown);

                                } else {
                                    toast_error(response.message);
                                }
                            });
                        }

                        // Add a click event handler for the "Delete" buttons
                        $('#phoneBookMasterTable').on('click', '.delete-phone-bookMaster', function(event) {
                            event.preventDefault(); // Prevent the default link behavior

                            const phoneBookMasterId = $(this).data(
                                'phone-book-master-id'); // Get the category ID from the data attribute
                            deletePhoneBookMaster(phoneBookMasterId);
                        });

                        function deletePhoneBookMaster(phoneBookMasterId) {

                            let sendApiDataObj = {
                                '<?php echo systemProject ?>': 'Masters',
                                '<?php echo systemModuleFunction ?>': 'deletePhoneBookMaster',
                                'phoneBookMasterId': phoneBookMasterId,
                            };
                            APICallAjax(sendApiDataObj, function(response) {
                                if (response.responseCode == RESULT_OK) {
                                    toast_success(response.message);
                                    getPhoneBookMaster();
                                } else {
                                    toast_error(response.message);
                                }
                            });
                        }

                        // Add a click event handler for the "Edit" buttons
                        $('#phoneBookMasterTable').on('click', '.edit-phone-book-master', function(event) {
                            event.preventDefault(); // Prevent the default link behavior
                            const phoneBookMasterId = $(this).data(
                                'phone-book-master-id'); // Get the category ID from the data attribute
                            let sendApiDataObj = {
                                '<?php echo systemProject ?>': 'Masters',
                                '<?php echo systemModuleFunction ?>': 'getPhoneBookMasterDetails',
                                'phoneBookMasterId': phoneBookMasterId,

                            };
                            window.location = "phonebook-master.php?id=" + phoneBookMasterId;

                        });



                        function deletePhoneBookMaster(phoneBookMasterId) {

                            let sendApiDataObj = {
                                '<?php echo systemProject ?>': 'Masters',
                                '<?php echo systemModuleFunction ?>': 'deletePhoneBookMaster',
                                'phoneBookMasterId': phoneBookMasterId,
                            };
                            APICallAjax(sendApiDataObj, function(response) {
                                if (response.responseCode == RESULT_OK) {
                                    toast_success(response.message);
                                    getPhoneBookMaster();
                                } else {
                                    toast_error(response.message);
                                }
                            });
                        }



                        $('#categoryId').on('change', function(event) {
                            getPhoneBookMaster();
                        });

                        function getPhoneBookMaster() {

                            let sendApiDataObj = {
                                '<?php echo systemProject ?>': 'Masters',
                                '<?php echo systemModuleFunction ?>': 'getPhoneBookMasterDetails',
                                'categoryId': $("#categoryId").val(),
                                'phoneBookMasterId': $("#phoneBookMasterId").val()

                            };
                            $("#phoneBookMasterTable").dataTable().fnDestroy();
                            $('#phoneBookMasterTable tbody').html('');
                            APICallAjax(sendApiDataObj, function(response) {
                                if (response.responseCode == RESULT_OK) {

                                    let html = '';
                                    let count = 1;

                                    $.each(response.result.phoneBookMaster, function(index, phoneBookMaster) {
                                        html += '<tr>';
                                        html += '<td>' + count + '</td>';
                                        html += '<td>' + phoneBookMaster.name + '</td>';
                                        html += '<td>' + phoneBookMaster.address + '</td>';
                                        html += '<td>' + phoneBookMaster.contactNumber + '</td>';
                                        html += '<td>' + phoneBookMaster.designation + '</td>';
                                        html += '<td>' + phoneBookMaster.companyName + '</td>';
                                        html += '<td>' + phoneBookMaster.remark + '</td>';
                                        html += '<td class="text-center-block py-0 align-middle">';
                                        html += '<div class = "" > ';
                                        html +=
                                            ' <button  class="btn btn-warning btn-sm edit-phone-book-master" data-phone-book-master-id="' +
                                            phoneBookMaster.id + '" title="Edit Phone Book">';
                                        html += '<i class = "fas fa-pen" > </i>';
                                        html += '</button>';
                                        html +=
                                            ' <button class="btn btn-danger btn-sm delete-phone-bookMaster" data-phone-book-master-id="' +
                                            phoneBookMaster.id + '" title="Delete Phone Book">';
                                        html += '<i class = "fas fa-trash" > </i>';
                                        html += '</button>';
                                        html += '</div>';
                                        html += '</td > ';
                                        html += '</tr>';
                                        count++;

                                    });
                                    $('#phoneBookMasterTable tbody').html(html);
                                    resetDataTable('phoneBookMasterTable');

                                } else {
                                    resetDataTable('phoneBookMasterTable');
                                    toast_error(response.message);
                                }
                            });
                        }
                        </script>
</body>

</html>