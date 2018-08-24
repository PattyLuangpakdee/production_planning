<?php
session_start();
include "connect.php";

$SQL_ORGANIZATION = "SELECT * FROM tb_organization";
$QUERY_ORGANIZATION = mysqli_query($conn, $SQL_ORGANIZATION);
$ARRAY_ORGANIZATION = mysqli_fetch_array($QUERY_ORGANIZATION);

$SQL_USER = "SELECT * FROM tb_user WHERE user_id = '".$_SESSION['login_user_id']."'";
$QUERY_USER = mysqli_query($conn, $SQL_USER);
$ARRAY_USER = mysqli_fetch_array($QUERY_USER);

if($thispage == 'index'){
    $TextHeader = 'Dashboard';
}elseif($thispage == 'basic_user'){
    $TextHeader = 'ข้อมูลผู้ใช้งาน';
}elseif($thispage == 'woven_length'){
    $TextHeader = 'มาตรฐานความยาว';
}elseif($thispage == 'woven_mesh'){
    $TextHeader = 'มาตรฐานขนาดตา';
}


if($_GET['mode'] == 'edit'){
    $TextStatus = 'แก้ไข';
}else{
    $TextStatus = 'เพิ่ม';
}
?>
