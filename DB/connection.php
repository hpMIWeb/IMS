<?php
$Base_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
/*============================= Start :Master Database Connection =============================== */

if (!in_array('localhost', explode('/', $Base_link))) {

    $master_servername = "localhost";
    $master_username = "husfilms_rmpho";
    $master_password = 'rmpho@2020';
    $master_db = "husfilms_rmphotoshoot";
} else {

    // local connection
    $master_servername = "localhost";
    $master_username = "root";
    $master_password = 'Password123*';
    $master_db = "ims";
}
// Create connection
$master_conn = new mysqli($master_servername, $master_username, $master_password, $master_db);

// Check connection
if ($master_conn->connect_error) {
    die("Connection failed: " . $master_conn->connect_error);
}
/*=============================  End : Master Database Connection =============================== */