<?php
session_start();
include "connect.php";
include "query.php";
$thispage = "woven_length";
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
                                            <a href="woven_length_manage.php"><button class="btn btn-primary btn-wd">เพิ่มข้อมูล</button></a>
                                            <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid">
                                                <thead>
                                                    <tr role="row">
                                                        <th>ลำดับ</th>
                                                        <th>ขนาดตา (นิ้ว)</th>
                                                        <th>ขนาดตา (ซม.)</th>
                                                        <th>%เผื่อ (ขนาดตา)</th>
                                                        <th>มาตรฐานโรงงาน (Min)</th>
                                                        <th>มาตรฐานโรงงาน (Max)</th>
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
                                                        $SQL_TB_WOVEN_LENGTH = "SELECT * FROM tb_woven_length ORDER BY woven_length_id ASC limit $page,$limit";
                                                    } elseif ($search != '') {
                                                        $SQL_TB_WOVEN_LENGTH = "SELECT * FROM tb_woven_length WHERE woven_length_id LIKE '%" . $search . "%' OR mesh_size_inch LIKE '%" . $search . "%' OR mesh_size_cm LIKE '%" . $search . "%' OR mesh_size_percent LIKE '%" . $search . "%' OR Factory_Standard_Min LIKE '%" . $search . "%' OR Factory_Standard_Max LIKE '%" . $search . "%' ORDER BY woven_length_id ASC";
                                                    }
                                                    $QUERY_TB_WOVEN_LENGTH = mysqli_query($conn, $SQL_TB_WOVEN_LENGTH);
                                                    $ROWS_TB_WOVEN_LENGTH = mysqli_num_rows($QUERY_TB_WOVEN_LENGTH);
                                                    while ($ARRAY_TB_WOVEN_LENGTH = mysqli_fetch_array($QUERY_TB_WOVEN_LENGTH)) {
                                                        $n++;
                                                        ?>
                                                        <tr role="row" class="odd">
                                                            <td><?= $n ?></td>
                                                            <td><?= $ARRAY_TB_WOVEN_LENGTH['woven_length_id'] ?></td>
                                                            <td><?= $ARRAY_TB_WOVEN_LENGTH['mesh_size_inch'] ?></td>
                                                            <td><?= $ARRAY_TB_WOVEN_LENGTH['mesh_size_cm'] ?></td>
                                                            <td><?= $ARRAY_TB_WOVEN_LENGTH['mesh_size_percent'] ?></td>
                                                            <td><?= $ARRAY_TB_WOVEN_LENGTH['Factory_Standard_Min'] ?></td>
                                                            <td><?= $ARRAY_TB_WOVEN_LENGTH['Factory_Standard_Max'] ?></td>
                                                            <td class="text-right">
                                                                <a href="woven_length_manage.php?mode=edit&woven_length_id=<?= $ARRAY_TB_WOVEN_LENGTH['woven_length_id'] ?>" class="btn btn-link btn-warning edit"><i class="fa fa-edit"></i></a>
                                                                <a href="woven_length_save.php?mode=del&woven_length_id=<?= $ARRAY_TB_WOVEN_LENGTH['woven_length_id'] ?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-link btn-danger remove"><i class="fa fa-times"></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <?php
                                    $SQL_ALL_ROWS = "SELECT * FROM tb_woven_length ORDER BY woven_length_id ASC";
                                    $RESULT_ALL_ROWS = mysqli_query($conn, $SQL_ALL_ROWS);
                                    $ROWS = mysqli_num_rows($RESULT_ALL_ROWS);
                                    $TOTAL_PAGE = ceil($ROWS / $limit);
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="datatables_info" role="status" aria-live="polite">
                                                &emsp;Showing <?= ceil($n+1 - $limit) ?> to <?= $n ?> of <?= $ROWS ?> entries
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_full_numbers" id="datatables_paginate">
                                                <ul class="pagination">
                                                    <?php
                                                    for ($i = 1; $i <= $TOTAL_PAGE; $i++) {
                                                        if ($start == $i) {
                                                            echo "<li class='paginate_button page-item '><a href='basic_woven_length.php?start=" . $i . "&limit=" . $limit . "' aria-controls='datatables' data-dt-idx='" . $i . "' tabindex='0' class='page-link'>" . $i . "</a></li>";
                                                        } else {
                                                            echo "<li class='paginate_button page-item active'><a href='basic_woven_length.php?start=" . $i . "&limit=" . $limit . "' aria-controls='datatables' data-dt-idx='" . $i . "' tabindex='0' class='page-link'>" . $i . "</a></li>";
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
