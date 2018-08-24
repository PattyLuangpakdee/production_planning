<?php
session_start();
include "connect.php";

$username = $_POST['username'];
$password = $_POST['password'];

$SQL_LOGIN = "SELECT * from tb_user where user_username='$username' and user_password='$password' ";
$QUERY_LOGIN = mysqli_query($conn, $SQL_LOGIN);
$NUM_LOGIN = mysqli_num_rows($QUERY_LOGIN);

if ($NUM_LOGIN == 1) {
    while ($ARRAY_LOGIN = mysqli_fetch_array($QUERY_LOGIN)) {
        $_SESSION['ses_userid'] = session_id();
        $_SESSION['login_user_id'] = $ARRAY_LOGIN['user_id'];
        $_SESSION['login_user_status'] = $ARRAY_LOGIN['user_status'];
        echo "<meta http-equiv='refresh' content='0; URL=index.php'>";
    }
} else {
    echo "<script>alert('Username and Password Incorrect!');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.php' />";   
}
?>
