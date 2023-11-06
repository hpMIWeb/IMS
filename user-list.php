<?php
session_start();
include_once './include/APICALL.php';
include_once './include/session-check.php';
include_once './include/common-constat.php';


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User List</title>
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
                            <h1>Users List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">User List</li>
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
                        <form>

                            <!-- /.card-header -->

                            <div class="card-body">

                                <table id="userCreateTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-1">Id</th>
                                            <th>FirstName</th>
                                            <th>LastName</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
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
        getUsers();
    });
    // Add a click event handler for the "Delete" buttons
    $('#userCreateTable').on('click', '.delete-user', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        const userId = $(this).data(
            'user-id'); // Get the category ID from the data attribute
        deleteUsers(userId);
    });



    function deleteUsers(userId) {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Sessions',
            '<?php echo systemModuleFunction ?>': 'deleteUsers',
            'userId': userId,
        };
        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {
                toast_success(response.message);
                getUser();
            } else {
                toast_error(response.message);
            }
        });
    }

    $('#userCreateTable').on('click', '.edit-user', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        const userId = $(this).data(
            'user-id'); // Get the category ID from the data attribute
        window.location = "create-users.php?id=" + userId;
    });

    function deleteUsers(userId) {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Sessions',
            '<?php echo systemModuleFunction ?>': 'deleteUsers',
            'userId': userId,
        };
        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {
                toast_success(response.message);
                getUsers();
            } else {
                toast_error(response.message);
            }
        });
    }

    function getUsers() {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Sessions',
            '<?php echo systemModuleFunction ?>': 'getUserDetails',

        };
        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {

                let html = '';
                let count = 1;

                $.each(response.result.user, function(index, user) {
                    html += '<tr>';
                    html += '<td>' + count + '</td>';
                    html += '<td>' + user.firstName + '</td>';
                    html += '<td>' + user.lastName + '</td>';
                    html += '<td>' + user.email + '</td>';
                    html += '<td>' + user.mobile + '</td>';
                    html += '<td class="text-center-block py-0 align-middle">';
                    html += '<div class = "" > ';
                    html +=
                        ' <button  class="btn btn-warning btn-sm edit-user" data-user-id="' +
                        user.id + '">';
                    html += '<i class = "fas fa-pen" > </i>';
                    html += '</button>';
                    html +=
                        ' <button class="btn btn-danger btn-sm delete-user" data-user-id="' +
                        user.id + '">';
                    html += '<i class = "fas fa-trash" > </i>';
                    html += '</button>';
                    html += '</div>';
                    html += '</td >';
                    html += '</tr>';
                    count++;

                });



                $('#userCreateTable tbody').html(html);
            } else {
                toast_error(response.message);
            }
        });
    }

    // Function to reset form fields
    function resetFormFields() {
        $('#firstName').val('');
        $('#lastName').val('');
        $('#userName').val('');
        $('#address').val('');
        $('#state').val('');
        $('#mobile').val('');
        $('#email').val('');
        $('#action').val('add');
    }
    </script>
</body>

</html>