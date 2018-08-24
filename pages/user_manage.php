<?php
session_start();
include "connect.php";
include "query.php";
$thispage = "basic_user";
include "header.php";
if (isset($_GET['mode']) == "") {
    $SQL_NEWID = "SELECT Max(substr(user_id,-6))+1 as MaxID FROM tb_user";
    $QUERY_NEWID = mysqli_query($conn, $SQL_NEWID);
    $ARRAY_NEWID = mysqli_fetch_array($QUERY_NEWID);
    if ($ARRAY_NEWID['MaxID'] == '') {
        $NEWID = "USER000001";
    } else {
        $NEWID = "USER" . sprintf("%06d", $ARRAY_NEWID['MaxID']);
    }
} elseif (isset($_GET['mode']) == "edit") {
    $SQL_EDIT = "SELECT * FROM tb_user WHERE user_id = '" . $_GET['user_id'] . "'";
    $QUERY_EDIT = mysqli_query($conn, $SQL_EDIT);
    $ARRAY_EDIT = mysqli_fetch_array($QUERY_EDIT);
    $NEWID = $_GET['user_id'];
    $img = "<table width=100% border=0>
                <tr>
                <td align=center><a href='" . $ARRAY_EDIT['user_img'] . "' target='_blank'><img src=" . $ARRAY_EDIT['user_img'] . " width=40% /></a></td>
                </tr>
            </table>";
    $imgText = "รูปถ่ายเดิม";
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header ">
                                <h4 class="card-title"><?= $TextStatus ?><?= $TextHeader ?></h4>
                            </div>
                            <div class="card-body ">
                                <form method="POST" action="user_save.php?mode=<?= $_GET['mode'] ?>" class="form-horizontal" autocomplete="OFF" enctype="multipart/form-data">
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">รหัสผู้ใช้งาน</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="user_id" value="<?= $NEWID ?>" readonly="" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">คำนำหน้า</label>
                                                <div class="col-sm-10">
                                                    <div class="form-check form-check-radio">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="user_title" value="นาย" checked="" <?PHP IF ($ARRAY_EDIT['user_title'] == 'นาย') {
    ECHO 'checked=""';
} ?>>
                                                            <span class="form-check-sign"></span>
                                                            นาย
                                                        </label>

                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="user_title" value="นาง" <?PHP IF ($ARRAY_EDIT['user_title'] == 'นาง') {
    ECHO 'checked=""';
} ?>>
                                                            <span class="form-check-sign"></span>
                                                            นาง
                                                        </label>

                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="user_title" value="นางสาว" <?PHP IF ($ARRAY_EDIT['user_title'] == 'นางสาว') {
    ECHO 'checked=""';
} ?>>
                                                            <span class="form-check-sign"></span>
                                                            นางสาว
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">ชื่อ</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="user_sername" value="<?= $ARRAY_EDIT['user_sername'] ?>" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">นามสกุล</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="user_lastname" value="<?= $ARRAY_EDIT['user_lastname'] ?>" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">Username</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="user_username" value="<?= $ARRAY_EDIT['user_username'] ?>" class="form-control" <?PHP IF ($_GET['mode'] == 'edit') {
    ECHO 'readonly=""';
} ?> required="">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">Password</label>
                                                <div class="col-sm-6">
                                                    <input type="password" name="user_password"  value="<?= $ARRAY_EDIT['user_password'] ?>" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">ตำแหน่ง</label>
                                                <div class="col-sm-6">
                                                    <select name="user_status" class="selectpicker" data-title="Select" data-style="btn-default btn-outline" data-menu-style="dropdown-blue" required="">
                                                        <option value="Admin" <?PHP IF ($ARRAY_EDIT['user_status'] == 'Admin') {
    ECHO 'selected=""';
} ?>>ADMIN</option>
                                                        <option value="User" <?PHP IF ($ARRAY_EDIT['user_status'] == 'User') {
    ECHO 'selected=""';
} ?>>USER</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">รูปถ่าย</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="file"/>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label"><?=$imgText?></label>
                                                <div class="col-sm-6">
<?= $img ?>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset><br><br>
                                    <button type="submit" class="btn btn-success btn-wd">บันทึก</button>
                                    <a onclick='window.history.back()'><button type="button" class="btn btn-danger btn-wd">ย้อนกลับ</button></a>
                                    <button type="reset" class="btn btn-warning btn-wd">ล้างค่า</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>
<?php
include "footer.php";
?>
</html>