<?php

require_once __DIR__ . "/_session.php";
require_once __DIR__ . "/_loginTeacher.php";
$date = new DateTime();

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 8/10/2018
 * Time: 4:05 PM
 */

$menuAction = 'check';
$menuCheck = isset($_REQUEST['class']) ? $_REQUEST['class'] : '1';
$student_id = isset($_REQUEST['student_id']) ? $_REQUEST['student_id'] : '1';
if ($menuCheck == 10) {
    $className = "อนุบาล 1";
} elseif ($menuCheck == 20) {
    $className = "อนุบาล 2";
} else {
    $className = "ประถมศึกษาปีที่ " . $menuCheck;
}

$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : $SCHOOL_YEAR;
$UrlYMD = isset($_REQUEST['ymd']) ? $_REQUEST['ymd'] : $date->format('Y-m-d');
$UrlYear = $UrlYear > 2500 ? $UrlYear - 543 : $UrlYear;
$year = date("Y");

//for calendar
$this_date = date("Y-m", strtotime($UrlYMD)) . '-01';
$day_m = date("m", strtotime($UrlYMD));//1 มกราคม
$day_y = date("Y", strtotime($UrlYMD));
$day_before = date("N", strtotime($this_date));//1-7 , 1=monday
if($day_before==7){$day_before=0;}
$day_count = cal_days_in_month(CAL_GREGORIAN, $day_m, $day_y);
$day_after = 7 - (($day_before + $day_count) % 7);
$new_line = $day_before;
$show_MY = $ARR_MONTH[$day_m - 1] . " " . ($day_y + 543);
//end calendar

//parameter
$studentName = '';
//end parameter
require_once __DIR__."/controller/teacherCheckShowController.php";
?>

<head>
    <?php include(__DIR__ . "/head.php"); ?>
    <style>
        @media (max-width: 575px) {
            .display-4 {
                font-size: 1.5rem;
            }

            .day h5 {
                background-color: #f8f9fa;
                padding: 3px 5px 5px;
                margin: -8px -8px 8px -8px;
            }

            .date {
                padding-left: 4px;
            }
        }

        @media (min-width: 576px) {
            .day {
                height: 100px;
            }
        }
    </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>

<div class="content-wrapper">

    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->
        <div class="mb-0 mt-4">
            <h2><i class="fa fa-check-square"></i> เช็คชื่อเข้าเรียน  (<strong><?php echo $studentName ; ?></strong> <small><?php echo $className ; ?></small>  ) </h2>
        </div>
        <hr class="mt-2">

        <!-- Example Social Card-->
        <div class="form-inline text-center">
            <div class="form-group">
                <label class="mr-3" for="select_month"> </label>
                <select class="form-control" id="select_month" name="year" onchange="changeMY();">
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                        <option value="<?php echo($i); ?>" <?php echo $day_m == $i ? 'selected' : '' ?>> <?php echo $ARR_MONTH[$i - 1]; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <label class="mr-3" for="select_year"> </label>
                <select class="form-control" id="select_year" name="year" onchange="changeMY();">
                    <?php for ($i = $year; $i > ($year - 10); $i--): ?>
                        <option value="<?php echo($i); ?>" <?php echo $day_y == $i ? 'selected' : '' ?>> <?php echo($i + 543); ?></option>
                    <?php endfor; ?>
                </select>
            </div>

        </div>


        <div class="container-fluid mb-5">

            <header>
                <h2 class="mb-4 mt-4 text-center"><?php echo $show_MY; ?></h2>
                <div class="row d-none d-sm-flex p-1 bg-dark text-white">
                    <h5 class="col-sm p-1 text-center">อาทิตย์</h5>
                    <h5 class="col-sm p-1 text-center">จันทร์</h5>
                    <h5 class="col-sm p-1 text-center">อังคาร</h5>
                    <h5 class="col-sm p-1 text-center">พุธ</h5>
                    <h5 class="col-sm p-1 text-center">พฤหัสบดี</h5>
                    <h5 class="col-sm p-1 text-center">ศุกร์</h5>
                    <h5 class="col-sm p-1 text-center">เสาร์</h5>
                </div>
            </header>

            <div class="row border border-right-0 border-bottom-0">

                <!-- before -->
                <?php for ($i = 0; $i < $day_before; $i++): ?>
                    <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                        <h5 class="row align-items-center">
                            <span class="date col-1"></span>
                        </h5>
                        <p class=""></p>
                    </div>
                <?php endfor; ?>
                <!-- end before -->

                <!-- day -->
                <?php for ($i = 0; $i < $day_count; $i++): ?>
                    <?php
                    if ($new_line % 7 == 0) {
                        echo '<div class="w-100"></div>';
                    }

                    $item_check_status = "";
                    $item_status = "-";
                    $item_alert = "alert-secondary";
                    $item_check_id = '0';
                    if(isset($studentCheckMonth[$i+1])){
                        $item_check_status = $studentCheckMonth[$i+1]['check_status'];
                        $item_status = $studentCheckMonth[$i+1]['note'];
                        $item_check_id = $studentCheckMonth[$i+1]['id'];

                    }

                    if( ($new_line) % 7 == 0|| $new_line % 7 == 6 ) {
                        $item_check_status='holiday';
                        $item_alert = 'alert-light';
                        if(isset($HOLIDAYLIST[$i+1])){
                            $item_check_status='holiday';
                            $item_alert = 'alert-light';
                            $item_status = $HOLIDAYLIST[$i+1]['detail'];
                        }else{
                            $item_status = ' ';
                        }
                    }elseif (isset($HOLIDAYLIST[$i+1])){
                        $item_check_status='holiday';
                        $item_alert = 'alert-light';
                        $item_status = $HOLIDAYLIST[$i+1]['detail'];
                    }elseif($item_check_status=='blank'){
                        $item_status = 'ยังไม่ตรวจสอบ';
                        $item_alert = 'alert-secondary';
                    }elseif($item_check_status=='missing'){
                        $item_status = 'ขาดเรียน';
                        $item_alert = 'alert-danger';
                    }elseif($item_check_status=='leave'){
                        $item_status = 'ลา';
                        $item_alert = 'alert-warning';
                    }elseif($item_check_status=='late'){
                        $item_status = 'สาย';
                        $item_alert = 'alert-primary';
                    }elseif($item_check_status=='come'){
                        $item_status = 'มาเรียน';
                        $item_alert = 'alert-success';
                    }elseif($item_check_status=='holiday'){
                        $item_alert = 'alert-light';
                    }
                    $new_line++;

                    ?>
                    <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                        <h5 class="row align-items-center">
                            <span class="date col-1"><?php echo($i + 1); ?></span>
                        </h5>
                        <div class="text-center alert <?php echo $item_alert;?>" role="alert">
                            <strong><?php echo $item_status; ?></strong>
                            <?php if($item_check_status!='holiday' && $item_status!='-' ): ?>
                            <button class="btn btn btn-outline-dark btn-sm" attr_id="<?php echo $item_check_id;?>"
                                    attr_status="<?php echo $item_check_status;?>" attr_day="<?php echo $day_y."-".$day_m."-".($i + 1); ?>"
                                    onclick="modalEditCheck(this);" ><i class="fa fa-edit"></i></button>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endfor; ?>
                <!-- end day -->

                <!-- after -->
                <?php for ($i = 0; $i < $day_after; $i++): ?>
                    <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                        <h5 class="row align-items-center">
                            <span class="date col-1"></span>
                        </h5>
                        <p class=""></p>
                    </div>
                    <?php $new_line++ ?>
                <?php endfor; ?>
                <!-- end after -->

            </div>

        </div>


    </div>
</body>

<div class="modal fade" id="modal-edit-check" tabindex="-1" role="dialog" aria-labelledby="myModalEditCheck" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <h5 class="modal-title"><strong><?php echo $studentName ; ?></strong> <small><?php echo $className ; ?></small></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="input_edit_day">วันที่</label>
                    <label id="input_edit_day" class="form-control"><?php echo $UrlYMD; ?></label>
                </div>
                <div class="form-group">
                    <label for="input_edit_status">รายละเอียด</label>
                    <select class="custom-select" id="input_edit_status" name="status">
                        <option value="blank">non</option>
                        <option value="come">ปกติ</option>
                        <option value="late">สาย</option>
                        <option value="leave">ลา</option>
                        <option value="missing">ขาด</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <input id="input_check_id" name="check_id" value="" hidden>
                <input name="fn" value="editCheck" hidden>
                <button type="submit" class="btn btn-warning">แก้ไข</button>
            </div>
        </form>
    </div>
</div>

<div class="value-attr" hidden>
    <input id="input_year" value="<?php echo $UrlYear; ?>">
    <input id="input_class" value="<?php echo $menuCheck; ?>">
    <input id="input_ymd" value="<?php echo $UrlYMD; ?>">
    <input id="input_student_id" value="<?php echo $student_id; ?>">
</div>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>

    <script>

        $(document).ready(function () {
            $('#table_check').DataTable({
                "lengthChange": false,
                "bInfo": false,
                "iDisplayLength": 100,
                "paging": false
            });
        });

        function changeMY() {
            var student_id = $('#input_student_id').val();
            var input_class = $('#input_class').val();
            var input_m = $('#select_month').val();
            var input_y = $('#select_year').val();
            var ymd = input_y+"-"+input_m+"-01";
            document.location = "teacher_checkshow.php?class=" + input_class + "&year=" + input_y + "&ymd=" + ymd+"&student_id="+student_id;
        }

        function modalEditCheck(res) {
            var check_id = $(res).attr('attr_id');
            var ymd = $(res).attr('attr_day');
            var status = $(res).attr('attr_status');
            $('#input_edit_day').html(ymd);
            $('#input_edit_status').val(status);
            $('#input_check_id').val(check_id);
            $("#modal-edit-check").modal('show');
        }


    </script>
</footer>

