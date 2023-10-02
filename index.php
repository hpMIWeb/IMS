<?php
session_start();
include_once './include/common-constat.php';
include_once './include/APICALL.php';


if (isset($_GET['status_error']) && $_GET['status_error'] == 'true') {
    $errormsg = '<error><div class="alert alert-danger" role="alert">Something wrong Please login again</div></error>';
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="./assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="./assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="./assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Mi Web Solutions</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <label style="display:none" class="btn btn-danger cls-danger kt-btn col-sm-12 msg">

                </label>
                <?php if (isset($errormsg) && $errormsg != "") {
                    echo $errormsg;
                } ?>
                <error id="errorMsgDiv">
                </error>
                <hr>
                <form action="#" method='POST' id="loginForm" onsubmit="return userLogin()">
                    <input type="hidden" name="webAT" id="webAT" value="" />
                    <input type="hidden" name="webRT" id="webRT" value="" />
                    <input type="hidden" name="login" id="login" value="" />
                    <div class=" input-group mb-3">

                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign
                                In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.php" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="./assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./assets/dist/js/adminlte.min.js"></script>

    <script>
        function userLogin() {
            authenticationForLogin(function(data) {
                if (data.responseCode == 1) {

                    $('#loginForm').removeAttr('onsubmit');
                    $('#loginForm').attr('action', 'authentication.php');
                    $('#webAT').val(data.result.AT);
                    localStorage.setItem("AT", data.result.AT);
                    localStorage.setItem("ROLE", data.result.roleId);
                    $('#webRT').val(data.result.RT);
                    localStorage.setItem("RT", data.result.RT);
                    $('#login').val('Submit');
                    $("#loginForm").submit();
                    return true;
                } else {
                    $('#errorMsgDiv').html('<div class="alert alert-danger" role="alert">' + data.message +
                        '</div>');
                }
                return false;

            });
            return false;

        }

        async function authenticationForLogin(callback) {
            let sendApiDataObj = {
                'systemProject': 'Sessions',
                'systemModuleFunction': 'login',
                'userMasterUsername': btoa($('#email').val()),
                'userMasterPassword': btoa($('#password').val()),
                'userMasterDeviceType': 'web',
                'userMasterDeviceId': '',
                'userMasterDeviceToken': '',
                'tokenValidityValue': '10',
                'tokenValidityType': 'days'
            };

            $.ajax({
                type: "POST",
                url: API_BASE_URL,
                async: false,
                data: sendApiDataObj,
                success: function(response) {
                    callback(response);
                },
                error: function(jqXHR, status, err) {
                    callback(err);
                }
            });


        }
    </script>


</body>

</html>