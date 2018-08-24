<?php
session_start();
include "connect.php";
switch ($_GET['mode']) {
    case "":
        $SQL_CHK = "SELECT * FROM tb_woven_mesh WHERE mesh_size_inch='" . $_POST['mesh_size_inch'] . "' OR mesh_size_cm='" . $_POST['mesh_size_cm'] . "'";
        $QUERY_CHK = mysqli_query($conn, $SQL_CHK);
        $NUM_CHK = mysqli_num_rows($QUERY_CHK);
        $ARRAY_CHK = mysqli_fetch_array($QUERY_CHK);
        $woven_mesh_id = $ARRAY_CHK['woven_mesh_id'];
        if ($NUM_CHK >= 1) {
            echo "<script>alert('ข้อมูลซ้ำ');</script>";
            echo "<META http-equiv='refresh' Content='0; URL=basic_woven_mesh.php?search=$woven_mesh_id'> ";
            exit();
        }
        $SQL_INSERT = "INSERT INTO tb_woven_mesh(woven_mesh_id,mesh_size_inch,mesh_size_cm,mesh_size_percent,Factory_Standard_Min,Factory_Standard_Max,Measure_eye) "
                . "VALUES('" . $_POST['woven_mesh_id'] . "','" . $_POST['mesh_size_inch'] . "','" . $_POST['mesh_size_cm'] . "','" . $_POST['mesh_size_percent'] . "','" . $_POST['Factory_Standard_Min'] . "','" . $_POST['Factory_Standard_Max'] . "','" . $_POST['Measure_eye'] . "')";
        $QUERY_INSERT = mysqli_query($conn, $SQL_INSERT);
        echo "<script>alert('เพิ่มข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_woven_mesh.php?search=$woven_mesh_id'> ";
        break;
    case "edit":
        $SQL_UPDATE = "UPDATE tb_woven_mesh SET woven_mesh_id='" . $_POST['woven_mesh_id'] . "',mesh_size_inch='" . $_POST['mesh_size_inch'] . "',mesh_size_cm='" . $_POST['mesh_size_cm'] . "',mesh_size_percent='" . $_POST['mesh_size_percent'] . "',Factory_Standard_Min='" . $_POST['Factory_Standard_Min'] . "',Factory_Standard_Max='" . $_POST['Factory_Standard_Max'] . "',Measure_eye='" . $_POST['Measure_eye'] . "' WHERE woven_mesh_id='" . $_POST['woven_mesh_id'] . "'";
        $QUERY_UPDATE = mysqli_query($conn, $SQL_UPDATE);
        $woven_mesh_id = $_POST['woven_mesh_id'];
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_woven_mesh.php?search=$woven_mesh_id'> ";
        break;
    case "del":
            $SQL_DELETE = "DELETE FROM tb_woven_mesh WHERE woven_mesh_id='" . $_GET['woven_mesh_id'] . "'";
            $QUERY_DELETE = mysqli_query($conn, $SQL_DELETE);
            echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว ');</script>";
            echo "<META http-equiv='refresh' Content='0; URL=basic_woven_mesh.php'> ";
        break;
}
?>