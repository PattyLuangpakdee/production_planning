<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="production_planning";
$charset="utf8";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn->set_charset($charset)) {
    die("Connection failed: " . mysqli_connect_error());
}
    //echo "Connected successfully";
// Set Time Zone
error_reporting( error_reporting() & ~E_NOTICE );
date_default_timezone_set("Asia/Bangkok");
$limit=10;
?>