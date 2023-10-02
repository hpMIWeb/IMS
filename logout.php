<?php
include_once './include/session-check.php';
include_once './include/common-constat.php';

session_start();
session_unset();
session_destroy();
$_SESSION['userId'] = '';
$_SESSION['loginFlag'] = false;
$_SESSION['userName'] = '';
header("location:index.php");
exit();
