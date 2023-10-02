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
    <title>Category</title>
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
                            <h1>Category</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">category</li>
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
                                            <input type="hidden" name="categoryId" id="categoryId" value="">
                                            <input type="hidden" name="action" id="action" value="add">
                                            <div class="col-6 form-group">
                                                <label>Name</label>
                                                <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Name">


                                            </div>
                                            <div class="col-6 form-group">

                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" name="add" id="add" class="form-control" placeholder="Enter Address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <input type="hidden" name="categoryId" id="categoryId" value="">
                                            <input type="hidden" name="action" id="action" value="add">
                                            <div class="col-6 form-group">
                                                <label>Contact Number</label>
                                                <input type="number" name="contact_number" id="contact_number" class="form-control" placeholder="Enter Contact Number">


                                            </div>
                                            <div class="col-6 form-group">

                                                <div class="form-group">
                                                    <label>Designation</label>
                                                    <input type="text" name="designation" id="designation" class="form-control" placeholder="designation">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <input type="hidden" name="categoryId" id="categoryId" value="">
                                            <input type="hidden" name="action" id="action" value="add">
                                            <div class="col-6 form-group">
                                                <label>Company Name</label>
                                                <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter company Name">


                                            </div>
                                            <div class="col-6 form-group">

                                                <div class="form-group">
                                                    <label>Remark</label>
                                                    <input type="text" name="remark" id="remark" class="form-control" placeholder="Remark">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="float-right">
                                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <table id="categoryTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="col-1">sr.no</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Contact Number</th>
                                                <th>Designation</th>
                                                <th>Company Name</th>
                                                <th>Remark</th>
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

                        getCategory();


                    });

                    // Add a click event handler for the "Delete" buttons
                    $('#categoryTable').on('click', '.delete-category', function(event) {
                        event.preventDefault(); // Prevent the default link behavior
                        const categoryId = $(this).data(
                            'category-id'); // Get the category ID from the data attribute
                        deleteCategory(categoryId);
                    });

                    $('#categoryTable').on('click', '.edit-category', function(event) {
                        event.preventDefault(); // Prevent the default link behavior
                        const categoryId = $(this).data(
                            'category-id'); // Get the category ID from the data attribute
                        let sendApiDataObj = {
                            '<?php echo systemProject ?>': 'Masters',
                            '<?php echo systemModuleFunction ?>': 'getCategoryMasterDetails',
                            'categoryId': categoryId,

                        };
                        APICallAjax(sendApiDataObj, function(response) {
                            if (response.responseCode == RESULT_OK) {
                                $.each(response.result.category, function(index, category) {
                                    $('#categoryId').val(category.id);
                                    $('#action').val("edit");
                                    $('#category_name').val(category.name);
                                    $('#contact_number').val(category.contact_number);
                                    $('#add').val(category.add);
                                    $('#designation').val(category.designation);
                                    $('#company_name').val(category.company_name);
                                    $('#remark').val(category.remark);
                                });

                            } else {
                                toast_error(response.message);
                            }
                        });
                    });

                    function deleteCategory(categoryId) {

                        let sendApiDataObj = {
                            '<?php echo systemProject ?>': 'Masters',
                            '<?php echo systemModuleFunction ?>': 'deleteCategory',
                            'categoryId': categoryId,
                        };
                        APICallAjax(sendApiDataObj, function(response) {
                            if (response.responseCode == RESULT_OK) {
                                toast_success(response.message);
                                getCategory();
                            } else {
                                toast_error(response.message);
                            }
                        });
                    }


                    $('#addUpdateCategoryButton').on('click', function(event) {
                        let name = $('#category_name').val();
                        let contact_number = $('#contact_number').val();
                        let add = $('#add').val();
                        let designation = $('#designation').val();
                        let remark = $('#remark').val();
                        let company_name = $('#company_name').val();
                        let description = $('#description').val();
                        let action = $('#action').val();
                        let categoryId = $('#categoryId').val();
                        let sendApiDataObj = {
                            '<?php echo systemProject ?>': 'Masters',
                            '<?php echo systemModuleFunction ?>': 'addUpdateCategoryMaster',
                            'categoryId': categoryId,
                            'name': name,
                            'description': description,
                            'action': action,
                        };
                        APICallAjax(sendApiDataObj, function(response) {
                            if (response.responseCode == RESULT_OK) {
                                getCategory();
                                toast_success(response.message);
                                resetFormFields()
                            } else {
                                toast_error(response.message);
                            }
                        });
                    });


                    function getCategory() {

                        let sendApiDataObj = {
                            '<?php echo systemProject ?>': 'Masters',
                            '<?php echo systemModuleFunction ?>': 'getCategoryMasterDetails',

                        };
                        APICallAjax(sendApiDataObj, function(response) {
                            if (response.responseCode == RESULT_OK) {

                                let html = '';
                                let count = 1;
                                $.each(response.result.category, function(index, category) {
                                    html += '<tr>';
                                    html += '<td>' + count + '</td>';
                                    html += '<td>' + category.name + '</td>';
                                    html += '<td>' + category.description + '</td>';
                                    html += '<td>' + add+'</td>';
                                    html += '<td>' + contaact_number+'</td>';
                                    html += '<td>' + designation +'</td>';
                                    html += '<td>' + company_name+'</td>';
                                    html += '<td>' + remark+'</td>';
                                    html += '<td>' + category.description + '</td>';

                                    html += '<td class="text-center-block py-0 align-middle">';
                                    html += '<div class = "" > ';
                                    html +=
                                        '<button  class="btn btn-warning btn-sm edit-category" data-category-id="' +
                                        category.id + '">';
                                    html += '<i class = "fas fa-eye" > </i>';
                                    html += '</button>';
                                    html +=
                                        ' <a href="#" class="btn btn-danger btn-sm delete-category" data-category-id="' +
                                        category.id + '">';
                                    html += '<i class = "fas fa-trash" > </i>';
                                    html += '</a>';
                                    html += '</div>';
                                    html += '</td > ';
                                    html += '</tr>';
                                    count++;

                                });
                                $('#categoryTable tbody').html(html);
                            } else {
                                toast_error(response.message);
                            }
                        });
                    }

                    // Function to reset form fields
                    function resetFormFields() {
                        $('#category_name').val('');
                        $('#description').val('');
                        $('#action').val('add');
                        $('#categoryId').val();
                    }
                </script>
</body>

</html>
</script>
</body>

</html>