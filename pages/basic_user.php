<?php
session_start();
include "connect.php";
include "query.php";
$thispage = "basic_user";
include "header.php";
?>
<div class="content">
    <div class="container-fluid">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card data-tables">
                            <div class="card-body table-striped table-no-bordered table-hover dataTable dtr-inline table-full-width">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>
                                <div class="fresh-datatables">
                                    <div id="datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <form method="GET">
                                                    <div id="datatables_filter" class="dataTables_filter">
                                                        <label>
                                                            <input type="search" class="form-control form-control-sm" name="search" placeholder="Search records">
                                                            <button type="submit" class="btn btn-default btn-small">Search</button>
                                                        </label>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <a href="user_manage.php"><button class="btn btn-primary btn-wd">เพิ่มข้อมูล</button></a>
                                            <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid">
                                                <thead>
                                                    <tr role="row">
                                                        <th>ลำดับ</th>
                                                        <th>รหัสผู้ใช้งาน</th>
                                                        <th>คำนำหน้า</th>
                                                        <th>ชื่อ-สกุล</th>
                                                        <th>ตำแหน่ง</th>
                                                        <th>จัดการ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($_GET['start'] == "" || $_GET['start'] == "1") {
                                                        $page = "0";
                                                    } else {
                                                        $page = ($_GET['start'] - 1) * $limit;
                                                    }
                                                    $n = $page;
                                                    $search = isset($_GET['search']) ? $_GET['search'] : "";

                                                    if ($search == '') {
                                                        $SQL_TB_USER = "SELECT * FROM tb_user ORDER BY user_id ASC limit $page,$limit";
                                                    } elseif ($search != '') {
                                                        $SQL_TB_USER = "SELECT * FROM tb_user WHERE user_id LIKE '%" . $search . "%' OR user_title LIKE '%" . $search . "%' OR user_sername LIKE '%" . $search . "%' OR user_lastname LIKE '%" . $search . "%' OR user_status LIKE '%" . $search . "%' ORDER BY user_id ASC";
                                                    }
                                                    $QUERY_TB_USER = mysqli_query($conn, $SQL_TB_USER);
                                                    $ROWS_TB_USER = mysqli_num_rows($QUERY_TB_USER);
                                                    while ($ARRAY_TB_USER = mysqli_fetch_array($QUERY_TB_USER)) {
                                                        $n++;
                                                        ?>
                                                        <tr role="row" class="odd">
                                                            <td><?= $n ?></td>
                                                            <td><?= $ARRAY_TB_USER['user_id'] ?></td>
                                                            <td><?= $ARRAY_TB_USER['user_title'] ?></td>
                                                            <td><?= $ARRAY_TB_USER['user_sername'] ?>  <?= $ARRAY_TB_USER['user_lastname'] ?></td>
                                                            <td><?= $ARRAY_TB_USER['user_status'] ?></td>
                                                            <td class="text-right">
                                                                <a href="user_manage.php?mode=edit&user_id=<?= $ARRAY_TB_USER['user_id'] ?>" class="btn btn-link btn-warning edit"><i class="fa fa-edit"></i></a>
                                                                <a href="user_save.php?mode=del&user_id=<?= $ARRAY_TB_USER['user_id'] ?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-link btn-danger remove"><i class="fa fa-times"></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="datatables_info" role="status" aria-live="polite">
                                                &emsp;Showing <?= ceil($ROWS_TB_USER / $limit) ?> to <?= $limit ?> of <?= $ROWS_TB_USER ?> entries
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_full_numbers" id="datatables_paginate">
                                                <ul class="pagination">
                                                    <?php
                                                    $SQL_ALL_ROWS = "SELECT * FROM tb_user ORDER BY user_id ASC";
                                                    $RESULT_ALL_ROWS = mysqli_query($conn, $SQL_ALL_ROWS);
                                                    $ROWS = mysqli_num_rows($RESULT_ALL_ROWS);
                                                    $TOTAL_PAGE = ceil($ROWS / $limit);
                                                    for ($i = 1; $i <= $TOTAL_PAGE; $i++) {
                                                        if ($start == $i) {
                                                            echo "<li class='paginate_button page-item '><a href='basic_user.php?start=" . $i . "&limit=" . $limit . "' aria-controls='datatables' data-dt-idx='" . $i . "' tabindex='0' class='page-link'>" . $i . "</a></li>";
                                                        } else {
                                                            echo "<li class='paginate_button page-item active'><a href='basic_user.php?start=" . $i . "&limit=" . $limit . "' aria-controls='datatables' data-dt-idx='" . $i . "' tabindex='0' class='page-link'>" . $i . "</a></li>";
                                                        }
                                                    }
                                                    ?> 
                                                </ul>
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
    </div>
</div>
</div>
</div>
</body>
<?php
include "footer.php";
?>
</html>
