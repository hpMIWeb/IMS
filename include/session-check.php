<?php
if (session_id() === "") session_start();

if (isset($_SESSION['loginFlag']) && $_SESSION['loginFlag']) {
} else {
    header("Location: index.php?status_error=true");
    exit;
}
