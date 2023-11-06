<?php

include_once './include/session-check.php';
include_once './include/APICALL.php';
include_once './include/common-constat.php';

$userId = isset($_GET['id']) ? $_GET['id'] : 0


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Create</title>
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
                            <h1>User Create</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">User create</li>
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
                                            <input type="hidden" name="userId" id="userId"
                                                value="<?php echo $userId; ?>">
                                            <input type="hidden" name="action" id="action" value="add">
                                            <div class="col-6 form-group">
                                                <label>First Name</label>
                                                <input type="text" name="firstName" id="firstName" class="form-control"
                                                    placeholder="Enter Frist Name">


                                                </select>
                                            </div>
                                            <div class="col-6 form-group">

                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" name="lastName" id="lastName"
                                                        class="form-control" placeholder="Enter Last Name">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-6 form-group">
                                                <label>User Name</label>
                                                <input type="text" name="userName" id="userName" class="form-control"
                                                    placeholder="Enter User Name">
                                            </div>
                                            <div class="col-6 form-group">
                                                <label>State:</label>
                                                <select name="state" id="state" class="form-control select2"
                                                    style="width: 100%; ">
                                                    <option selected="selected"></option>
                                                    <option>Gujarat</option>
                                                    <option>Maharastra</option>
                                                    <option>Kerala</option>
                                                    <option>Punjab</option>
                                                </select>
                                                <div class="form-group">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-6 form-group">
                                                <label>Address</label>
                                                <input type="text" name="address" id="address" class="form-control"
                                                    placeholder="Enter Address">
                                            </div>
                                            <div class="col-6 form-group">

                                                <div class="form-group">
                                                    <label>Email Id</label>
                                                    <input type="text" name="email" id="email" class="form-control"
                                                        placeholder="Emate Email Id">
                                                </div>
                                            </div>
                                            <div class="col-6 form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control" placeholder="Enter Password">
                                            </div>
                                            <div class="col-6 form-group">

                                                <label>Contact Number</label>
                                                <input type="text" name="contactNumber" id="contactNumber"
                                                    class="form-control" placeholder="Enter Contact Number">

                                            </div>
                                            <div class="col-6 form-group">

                                                <label>Confirm Password</label>
                                                <input type="password" name="cpassword" id="cpassword"
                                                    class="form-control" placeholder="Enter Confrirm Password">

                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="float-right">
                                            <button type="button" id="addUpdateUserCreateButton" name="submit"
                                                class="btn btn-primary">Save</button>
                                            <button type="button" name="delete" class="btn btn-danger"
                                                onclick="resetFormFields()">Delete</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- /.card-body -->
                        </div>

                    </div>
                    <!-- /.col -->
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

        let userId = $('#userId').val();
        if (userId !== '0') {
            getUserData(userId)
        }


    });

    function getUserData(userId) {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Sessions',
            '<?php echo systemModuleFunction ?>': 'getUserDetails',
            'userId': userId,

        };
        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {
                $.each(response.result.user, function(index, user) {

                    $('#firstName').val(user.firstName);
                    $('#lastName').val(user.lastName);
                    $('#userName').val(user.userName);
                    $('#address').val(user.address);
                    $('#state').val(user.state).trigger('change');
                    $('#contactNumber').val(user.mobile);
                    $('#cpassword').val(user.password);
                    $('#password').val(user.password);
                    $('#email').val(user.email);
                    $('#action').val('edit');
                });

            } else {
                toast_error(response.message);
            }
        });
    }

    function deleteUsers(userId) {

        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Sessions',
            '<?php echo systemModuleFunction ?>': 'deleteUsers',
            'userId': userId,
        };
        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {
                toast_success(response.message);
                get();
            } else {
                toast_error(response.message);
            }
        });
    }


    $('#addUpdateUserCreateButton').on('click', function(event) {
        let firstName = $('#firstName').val();
        let lastName = $('#lastName').val();
        let userName = $('#userName').val();
        let address = $('#address').val();
        let state = $('#state').val();
        let mobile = $('#contactNumber').val();
        let password = $('#password').val();
        let email = $('#email').val();
        let action = $('#action').val();
        let userId = $('#userId').val();
        let sendApiDataObj = {
            '<?php echo systemProject ?>': 'Sessions',
            '<?php echo systemModuleFunction ?>': 'addUpdateCreateUser',
            'userId': userId,
            'firstName': firstName,
            'lastName': lastName,
            'userName': userName,
            'address': address,
            'state': state,
            'mobile': mobile,
            'password': password,
            'email': email,
            'action': $('#action').val(),
        };

        APICallAjax(sendApiDataObj, function(response) {
            if (response.responseCode == RESULT_OK) {
                toast_success(response.message);
                window.location = "user-list.php";
                resetFormFields()
            } else {
                toast_error(response.message);
            }
        });
    });

    // Function to reset form fields
    function resetFormFields() {
        $('#firstName').val('');
        $('#lastName').val('');
        $('#userName').val('');
        $('#address').val('');
        $('#state').val('');
        $('#mobile').val('');
        $('#password').val('');
        $('#email').val('');
        $('#action').val('add');
        $('#userId').val();
    }
    </script>
</body>

</html>