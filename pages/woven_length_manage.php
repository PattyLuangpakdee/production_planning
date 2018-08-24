<?php
session_start();
include "connect.php";
include "query.php";
$thispage = "woven_length";
include "header.php";
if (isset($_GET['mode']) == "") {
    $SQL_NEWID = "SELECT Max(substr(woven_length_id,-7))+1 as MaxID FROM tb_woven_length";
    $QUERY_NEWID = mysqli_query($conn, $SQL_NEWID);
    $ARRAY_NEWID = mysqli_fetch_array($QUERY_NEWID);
    if ($ARRAY_NEWID['MaxID'] == '') {
        $NEWID = "WL-0000001";
    } else {
        $NEWID = "WL-" . sprintf("%07d", $ARRAY_NEWID['MaxID']);
    }
} elseif (isset($_GET['mode']) == "edit") {
    $SQL_EDIT = "SELECT * FROM tb_woven_length WHERE woven_length_id = '" . $_GET['woven_length_id'] . "'";
    $QUERY_EDIT = mysqli_query($conn, $SQL_EDIT);
    $ARRAY_EDIT = mysqli_fetch_array($QUERY_EDIT); 
    $NEWID = $_GET['woven_length_id'];
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
                                <h4 class="card-title"><?=$TextStatus?><?=$TextHeader?></h4>
                            </div>
                            <div class="card-body ">
                                <form method="POST" action="woven_length_save.php?mode=<?=$_GET['mode']?>" class="form-horizontal" autocomplete="OFF">
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">รหัส มตฐ.ความยาว</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="woven_length_id" value="<?=$NEWID?>" readonly="" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">ขนาดตา (นิ้ว)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="mesh_size_inch" value="<?=$ARRAY_EDIT['mesh_size_inch']?>" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">ขนาดตา (ซม.)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="mesh_size_cm" value="<?=$ARRAY_EDIT['mesh_size_cm']?>" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">%เผื่อ (ขนาดตา)</label>
                                                <div class="col-sm-6">
                                                    <input type="number" step=any name="mesh_size_percent" value="<?=$ARRAY_EDIT['mesh_size_percent']?>" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">มาตรฐานโรงงาน (Min)</label>
                                                <div class="col-sm-6">
                                                    <input type="number" step=any name="Factory_Standard_Min"  value="<?=$ARRAY_EDIT['Factory_Standard_Min']?>" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label">มาตรฐานโรงงาน (Max)</label>
                                                <div class="col-sm-6">
                                                    <input type="number" step=any name="Factory_Standard_Max"  value="<?=$ARRAY_EDIT['Factory_Standard_Max']?>" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br><br>
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