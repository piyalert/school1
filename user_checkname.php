<?php
require_once __DIR__ . "/_session.php";
require_once __DIR__ . "/_loginStudent.php";
$date = new DateTime();

$menuAction = 'check';
$year = date("Y");
$UrlYMD = isset($_REQUEST['ymd']) ? $_REQUEST['ymd'] : date("Y-m-d");
$user_id = $SESSION_user_id;
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

require_once __DIR__.'/controller/userCheckNameController.php';
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
            <h2><i class="fa fa-check-square"></i> เช็คชื่อเข้าเรียน</h2></div>
        <hr class="mt-2">

        <!-- Example Social Card-->
        <div class="form-inline">
            <div class="form-group ml-5">
                <label class="mr-3" for="input_ymd"> วันที่ </label>
                <input class="form-control" id="select_ymd" name="input_ymd" type="date" value="<?php echo $UrlYMD; ?>" onchange="changeYMD();">
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

                <?php
                $missing = 0;
                $leave = 0;
                $late = 0;
                $come = 0;
                $blank = 0;
                ?>
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
                        $blank = $blank+1;
                    }elseif($item_check_status=='missing'){
                        $item_status = 'ขาดเรียน';
                        $item_alert = 'alert-danger';
                        $missing = $missing+1;
                    }elseif($item_check_status=='leave'){
                        $item_status = 'ลา';
                        $item_alert = 'alert-warning';
                        $leave = $leave+1;
                    }elseif($item_check_status=='late'){
                        $item_status = 'สาย';
                        $item_alert = 'alert-primary';
                        $late = $late+1;
                    }elseif($item_check_status=='come'){
                        $item_status = 'มาเรียน';
                        $item_alert = 'alert-success';
                        $come = $come+1;
                    }elseif($item_check_status=='holiday'){
                        $item_alert = 'alert-light';
                    }

                    $new_line++;

                    ?>
                    <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate">
                        <h5 class="row align-items-center">
                            <span class="date col-1"><?php echo($i + 1); ?></span>
                        </h5>
                        <div class="text-center alert <?php echo $item_alert;?>" role="alert">
                            <strong><?php echo $item_status; ?></strong>
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

            <div class="pt-0">
                <span>
                    มาเรียน ( <strong class="text-success"><?=$come;?></strong> )
                    สาย ( <strong class="text-primary"><?=$late;?></strong> )
                    ลา ( <strong class="text-warning"><?=$leave;?></strong> )
                    ขาดเรียน ( <strong class="text-danger"><?=$missing;?></strong> )
                    ยังไม่ตรวจสอบ ( <strong class="text-secondary"><?=$blank;?></strong> )
                </span>
            </div>

        </div>


    </div>
</body>



<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>

    <script>

        function changeYMD() {
            var input_date = $('#select_ymd').val();
            document.location = "user_checkname.php?ymd="+input_date;
        }

    </script>
</footer>