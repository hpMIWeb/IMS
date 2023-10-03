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
                            <h1>PhoneBook-Master</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">phonebook-master</li>
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
                                            <input type="hidden" name="phonebookMasterId" id="phonebookMasterId" value="">
                                            <input type="hidden" name="action" id="action" value="add">
                                            <div class="col-6 form-group">
                                                <label>Category</label>
                                                <select name="category" id="category" class="form-control select2" style="width: 100%; ">
                                                    <option selected="selected"></option>

                                                </select>
                                            </div>
                                            <div class="col-6 form-group">

                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-6 form-group">
                                                <label>Name</label>
                                                <input type="text" name="categoryName" id="categoryName" class="form-control" placeholder="Enter Name">
                                            </div>
                                            <div class="col-6 form-group">

                                                <div class="form-group">
                                                    <label>Designation</label>
                                                    <input type="text" name="designation" id="designation" class="form-control" placeholder="designation">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-6 form-group">
                                                <label>Company Name</label>
                                                <input type="text" name="companyName" id="companyName" class="form-control" placeholder="Enter company Name">
                                            </div>
                                            <div class="col-6 form-group">

                                                <div class="form-group">
                                                    <label>Remark</label>
                                                    <input type="text" name="remark" id="remark" class="form-control" placeholder="Remark">
                                                </div>
                                            </div>
                                            <div class="col-6 form-group">
                                                <label>Contact Number</label>
                                                <input type="text" name="contactNumber" id="contactNumber" class="form-control" placeholder="Enter Contact Number">
                                            </div>
                                            <div class="col-6 form-group">

                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="float-right">
                                            <button type="button" id="addUpdatePhonebookMasterButton" name="submit" class="btn btn-primary">Save</button>
                                            <button type="button" name="delete" class="btn btn-danger" onclick="resetFormFields()">Delete</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <table id="phonebookMasterTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="col-1">sr.no</th>
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
                    $(document).ready(function() {

                        getPhonebookMaster();
                        getCategory();


                    });

                    function getCategory() {

                        let sendApiDataObj = {
                            '<?php echo systemProject ?>': 'Masters',
                            '<?php echo systemModuleFunction ?>': 'getCategoryMasterDetails',

                        };
                        APICallAjax(sendApiDataObj, function(response) {
                            if (response.responseCode == RESULT_OK) {

                                let html = '';

                                $.each(response.result.category, function(index, category) {
                                    html += '<option value = "' + category.id + '" > ' + category.name + ' </option>';
                                });
                                $('#category').html(html);

                            } else {
                                toast_error(response.message);
                            }
                        });
                    }

                    // Add a click event handler for the "Delete" buttons
                    $('#phonebookMasterTable').on('click', '.delete-phonebookMaster', function(event) {
                        event.preventDefault(); // Prevent the default link behavior

                        const phonebookMasterId = $(this).data(
                            'phonebookmaster-id'); // Get the category ID from the data attribute
                        console.log(phonebookMasterId)
                        deletePhonebookMaster(phonebookMasterId);
                    });



                    function deletePhonebookMaster(phonebookMasterId) {

                        let sendApiDataObj = {
                            '<?php echo systemProject ?>': 'Masters',
                            '<?php echo systemModuleFunction ?>': 'deletePhonebookMaster',
                            'phonebookMasterId': phonebookMasterId,
                        };
                        APICallAjax(sendApiDataObj, function(response) {
                            if (response.responseCode == RESULT_OK) {
                                toast_success(response.message);
                                getPhonebookMaster();
                            } else {
                                toast_error(response.message);
                            }
                        });
                    }

                    $('#phonebookMasterTable').on('click', '.edit-phonebookMaster', function(event) {
                        event.preventDefault(); // Prevent the default link behavior
                        const phonebookMasterId = $(this).data(
                            'phonebookmaster-id'); // Get the category ID from the data attribute
                        let sendApiDataObj = {
                            '<?php echo systemProject ?>': 'Masters',
                            '<?php echo systemModuleFunction ?>': 'getPhonebookMasterDetails',
                            'phonebookMasterId': phonebookMasterId,

                        };
                        APICallAjax(sendApiDataObj, function(response) {
                            if (response.responseCode == RESULT_OK) {
                                $.each(response.result.phoneBookMaster, function(index, phoneBookMaster) {
                                    console.log(phoneBookMaster)
                                    $('#phonebookMasterId').val(phoneBookMaster.id);
                                    $('#action').val("edit");
                                    $('#category').val(phoneBookMaster.category).trigger('change');
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
                    });

                    function deletephonebookMaster(PhonebookMasterId) {

                        let sendApiDataObj = {
                            '<?php echo systemProject ?>': 'Masters',
                            '<?php echo systemModuleFunction ?>': 'deletephonebookMaster',
                            'PhonebookMasterId': PhonebookMasterId,
                        };
                        APICallAjax(sendApiDataObj, function(response) {
                            if (response.responseCode == RESULT_OK) {
                                toast_success(response.message);
                                getPhonebookMaster();
                            } else {
                                toast_error(response.message);
                            }
                        });
                    }


                    $('#addUpdatePhonebookMasterButton').on('click', function(event) {
                        let category = $('#category').val();
                        let name = $('#categoryName').val();
                        let address = $('#address').val();
                        let action = $('#action').val();
                        let contactNumber = $('#contactNumber').val();
                        let designation = $('#designation').val();
                        let companyName = $('#companyName').val();
                        let remark = $('#remark').val();
                        let phonebookMasterId = $('#phonebookMasterId').val();
                        let sendApiDataObj = {
                            '<?php echo systemProject ?>': 'Masters',
                            '<?php echo systemModuleFunction ?>': 'addUpdatePhonebookMaster',
                            'phonebookMasterId': phonebookMasterId,
                            'name': name,
                            'address': address,
                            'contactNumber': contactNumber,
                            'designation': designation,
                            'companyName': companyName,
                            'remark': remark,
                            'action': action,
                            'category': category
                        };

                        APICallAjax(sendApiDataObj, function(response) {
                            if (response.responseCode == RESULT_OK) {
                                getPhonebookMaster();
                                toast_success(response.message);
                                resetFormFields()
                            } else {
                                toast_error(response.message);
                            }
                        });
                    });


                    function getPhonebookMaster() {

                        let sendApiDataObj = {
                            '<?php echo systemProject ?>': 'Masters',
                            '<?php echo systemModuleFunction ?>': 'getPhonebookMasterDetails',

                        };
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
                                        '<button  class="btn btn-warning btn-sm edit-phonebookMaster" data-phonebookmaster-id="' +
                                        phoneBookMaster.id + '">';
                                    html += '<i class = "fas fa-eye" > </i>';
                                    html += '</button>';
                                    html +=
                                        '<button class="btn btn-danger btn-sm delete-phonebookMaster" data-phonebookmaster-id="' +
                                        phoneBookMaster.id + '">';
                                    html += '<i class = "fas fa-trash" > </i>';
                                    html += '</button>';
                                    html += '</div>';
                                    html += '</td > ';
                                    html += '</tr>';
                                    count++;

                                });

                                $('#phonebookMasterTable tbody').html(html);
                            } else {
                                toast_error(response.message);
                            }
                        });
                    }

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
                        $('#phonebookMasterId').val();
                    }
                </script>
</body>

</html>
</script>
</body>

</html>