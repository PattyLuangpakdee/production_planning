<?php
session_start();
include "connect.php";
switch ($_GET['mode']) {
    case "":
        $SQL_CHK = "SELECT * FROM tb_user WHERE user_sername='" . $_POST['user_sername'] . "' AND user_lastname='" . $_POST['user_lastname'] . "' OR user_username='" . $_POST['user_username'] . "'";
        $QUERY_CHK = mysqli_query($conn, $SQL_CHK);
        $NUM_CHK = mysqli_num_rows($QUERY_CHK);
        $ARRAY_CHK = mysqli_fetch_array($QUERY_CHK);
        $user_id = $ARRAY_CHK['user_id'];
        if ($NUM_CHK >= 1) {
            echo "<script>alert('ข้อมูลซ้ำ');</script>";
            echo "<META http-equiv='refresh' Content='0; URL=basic_user.php?search=$user_id'> ";
            exit();
        }
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $dir = "../production_planning/assets/img/user/" . $_POST['file'] . ".png";
            copy($_FILES['file']['tmp_name'], "$dir");
        } else {
            $dir = "../assets/img/user/user.png";
            copy($_FILES['file']['tmp_name'], "$dir");
        }
        $SQL_INSERT = "INSERT INTO tb_user(user_id,user_title,user_sername,user_lastname,user_username,user_password,user_status,user_img) "
                . "VALUES('" . $_POST['user_id'] . "','" . $_POST['user_title'] . "','" . $_POST['user_sername'] . "','" . $_POST['user_lastname'] . "','" . $_POST['user_username'] . "','" . $_POST['user_password'] . "','" . $_POST['user_status'] . "','" . $dir . "')";
        $QUERY_INSERT = mysqli_query($conn, $SQL_INSERT);
        echo "<script>alert('เพิ่มข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_user.php?search=$user_id'> ";
        break;
    case "edit":
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $dir = "../production_planning/assets/img/user/" . $_POST['file'] . ".png";
            copy($_FILES['file']['tmp_name'], "$dir");
        } else {
            $SQL_CHK_IMG = "SELECT * FROM tb_user WHERE user_id='" . $_POST['user_id'] . "'";
            $QUERY_CHK_IMG = mysqli_query($conn, $SQL_CHK_IMG);
            $ARRAY_CHK_IMG = mysqli_fetch_array($QUERY_CHK_IMG);
            $dir = $ARRAY_CHK_IMG['user_img'];
        }
        $SQL_UPDATE = "UPDATE tb_user SET user_id='" . $_POST['user_id'] . "',user_title='" . $_POST['user_title'] . "',user_sername='" . $_POST['user_sername'] . "',user_lastname='" . $_POST['user_lastname'] . "',user_username='" . $_POST['user_username'] . "',user_password='" . $_POST['user_password'] . "',user_status='" . $_POST['user_status'] . "',user_img='" . $dir . "' WHERE user_id='" . $_POST['user_id'] . "'";
        $QUERY_UPDATE = mysqli_query($conn, $SQL_UPDATE);
        $user_id = $_POST['user_id'];
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_user.php?search=$user_id'> ";
        break;
    case "del":
            $SQL_DELETE = "DELETE FROM tb_user WHERE user_id='" . $_GET['user_id'] . "'";
            $QUERY_DELETE = mysqli_query($conn, $SQL_DELETE);
            echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว ');</script>";
            echo "<META http-equiv='refresh' Content='0; URL=basic_user.php'> ";
        break;
}
?>