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
    <title>category</title>
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
                            <h1>Category</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Category</li>
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
                                            <div class="col-4 form-group">
                                                <label>Name</label>
                                                <input type="text" name="category_name" id="category_name"
                                                    class="form-control" placeholder="Enter Name">


                                            </div>
                                            <div class="col-4 form-group">

                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <input type="text" name="description" id="description"
                                                        class="form-control" placeholder="Description..">
                                                </div>
                                            </div>
                                            <div class="col-4 text-center mt-4 mb-2">
                                                <button class="btn  btn-primary"
                                                    id="addUpdateCategoryButton">Save</button>
                                                <button type="reset" class="btn btn-danger"
                                                    onclick="resetFormFields()">Cancel</a>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>

                            <div class="card-body">

                                <table id="categoryTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-1">Id</th>
                                            <th>Category Name</th>
                                            <th>Description</th>
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
        <div class="modal fade" id="modal-sm">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Warning</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="deleteMsg">Are you Sure want to Delete?</p>
                        <input id="deleteCategoryId" value="" type="hidden">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="deleteCategory()">Delete</button>
                    </div>
                </div>

            </div>

        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->

        <?php

include_once "include/jquery.php";

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
            const itemName = $(this).data('category-name');
            $('#deleteMsg').html('Are you Sure want to delete <b>' + itemName + ' ?');

            $('#deleteCategoryId').val(categoryId);
            $('#modal-sm').modal('show');

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
                        $('#description').val(category.description);
                        $('#category_name').val(category.name);

                    });

                } else {
                    toast_error(response.message);
                }
            });
        });


        function deleteCategory() {

            let sendApiDataObj = {
                '<?php echo systemProject ?>': 'Masters',
                '<?php echo systemModuleFunction ?>': 'deleteCategory',
                'categoryId': $('#deleteCategoryId').val(),
            };
            APICallAjax(sendApiDataObj, function(response) {
                if (response.responseCode == RESULT_OK) {
                    toast_success(response.message);
                    $('#modal-sm').modal('hide');
                    getCategory();
                } else {
                    toast_error(response.message);
                }
            });
        }


        $('#addUpdateCategoryButton').on('click', function(event) {
            let name = $('#category_name').val();
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
                        html += '<td class="text-center-block py-0 align-middle">';
                        html += '<div class = "" > ';
                        html +=
                            '<button  class="btn btn-warning btn-sm edit-category" data-category-id="' +
                            category.id + '">';
                        html += '<i class = "fas fa-eye" > </i>';
                        html += '</button>';
                        html +=
                            ' <a href="#" class="btn btn-danger btn-sm delete-category" data-category-id="' +
                            category.id + '" data-category-name="' +
                            category.name + '">';
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