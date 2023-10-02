<?php
session_start();
error_reporting(1);

include("DB/connection.php");

if (true) {
    $username = trim($_POST['email']);
    $password = trim($_POST['password']);

    $userResult = mysqli_query($master_conn, "select * from user_master where email='$username' AND password='$password'");
    $userRow = mysqli_fetch_assoc($userResult);
    $total = mysqli_num_rows($userResult);

    if ($userRow['user_status'] == '1') {
        if ($total > 0) {
            $_SESSION['userId'] = $userRow['id'];
            $_SESSION['loginFlag'] = true;
            $_SESSION['userName'] = $userRow['username'];
            $_SESSION['userRole'] = $userRow['role'];
            $params = session_get_cookie_params();
            setcookie('AT', $_POST['webAT'], time() + (86400 * 30), "/", "", true, true);
            setcookie('RT', $_POST['webRT'], time() + (86400 * 30), "/", "", true, true);
            header("Location: dashboard.php");
            exit;
        } else {
            $_SESSION['loginFlag'] = false;
            header("Location: index.php?error=true");
            exit;
        }
    } else {
        header("Location: index.php?error_msg_status=true");
        exit;
    }
} else {
    echo "something Wrong...!!";
}
