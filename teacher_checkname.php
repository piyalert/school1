<?php
require_once __DIR__ . "/_session.php";
require_once __DIR__ . "/_loginTeacher.php";
$date = new DateTime();

$menuAction = 'check';
$menuCheck = isset($_REQUEST['class']) ? $_REQUEST['class'] : '';
if ($menuCheck == 10) {
    $className = "อนุบาล 1";
} elseif ($menuCheck == 20) {
    $className = "อนุบาล 2";
} else {
    $className = "ประถมศึกษาปีที่ " . $menuCheck;
}

$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : $SCHOOL_YEAR;
$UrlYMD = isset($_REQUEST['ymd']) ? $_REQUEST['ymd'] : $date->format('Y-m-d');
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");

require_once __DIR__.'/controller/teacherCheckNameController.php';
?>

<head>
    <?php include(__DIR__ . "/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>

<div class="content-wrapper">

    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->
        <div class="mb-0 mt-4">
            <h2><i class="fa fa-check-square"></i> เช็คชื่อเข้าเรียน  <?php echo $className; ?></h2></div>
        <hr class="mt-2">

        <!-- Example Social Card-->
        <div class="form-inline">
            <div class="form-group ml-5">
                <label class="mr-3" for="input_year" > ปีการศึกษา </label>
                <select class="form-control" id="input_year" name="year" onchange="changeYMD();">
                    <?php for ($i=$year;$i>($year-10);$i--): ?>
                        <option value="<?php echo ($i);?>"  <?php echo $UrlYear==$i?'selected':'' ?>> <?php echo ($i+543); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group ml-5">
                <label class="mr-3" for="input_ymd"> วันที่ </label>
                <input class="form-control" id="select_ymd" name="input_ymd" type="date" value="<?php echo $UrlYMD; ?>" onchange="changeYMD();">
            </div>
            <div class="form-group ml-5">
                <button class="btn btn-success" data-toggle="modal" data-target=".modal-add-holiday"> <i class="fa fa-plus"></i> เพิ่มวันหยุด</button>
            </div>
        </div>

        <div class="pt-3 pl-2">
            <?php foreach ($HOLIDAYLIST as $item): ?>
            <p><?php echo $item['ymd'].' '.$item['detail']; ?>
                <i class="btn btn-warning btn-sm fa fa-edit" data-toggle="modal" data-target=".modal-edit-holiday"
                   attr_id ="<?php echo $item['id'];?>" attr_day ="<?php echo $item['ymd'];?>" attr_detail ="<?php echo $item['detail'];?>"
                   onclick="modalEditHoliday(this);"
                ></i>
            </p>
            <?php endforeach; ?>
        </div>

        <table id="table_check" class="table table-striped table-bordered table-hover" style="width:100%;">
            <thead style="font-size: 12px;">
            <tr class="text-center">
                <th>#</th>
                <th>ชื่อ-นามสกุล</th>
                <th>เข้าเรียน</th>
                <th>ยังไม่เช็ค</th>
                <th>สาย</th>
                <th>ลา</th>
                <th>ขาดเรียน</th>
                <th>action</th>
                <th>หมายเหตุ</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($CHECKLIST as $key=>$item): ?>
                <?php
                $is = isset($LASTLIST[$item['id']])?$LASTLIST[$item['id']]:'blank';
                $al_blank = $is=='blank'?'alert-danger':'';
                ?>
            <tr class="text-center">
                <td><?php echo ($key+1) ;?></td>
                <td><a href="teacher_checkshow.php?class=<?php echo $menuCheck;?>&ymd=<?php echo$UrlYMD ;?>&student_id=<?php echo $item['id']; ?>"><?php echo $item['name']." ".$item['surname'] ;?></a></td>
                <td> <?php echo is_numeric($item['s_come'])?$item['s_come']:0 ;?></td>
                <td> <?php echo is_numeric($item['s_blank'])?$item['s_blank']:0 ;?> </td>
                <td> <?php echo is_numeric($item['s_late'])?$item['s_late']:0 ;?> </td>
                <td> <?php echo is_numeric($item['s_leave'])?$item['s_leave']:0 ;?> </td>
                <td> <?php echo is_numeric($item['s_missing'])?$item['s_missing']:0 ;?> </td>

                <td class="<?php echo $al_blank;?>">
                    <select class="custom-select" id="check_<?php echo $item['id']; ?>">
                        <option value="blank">non</option>
                        <option value="come" <?php echo ($is=='come')?'selected':'' ;?>>ปกติ</option>
                        <option value="late" <?php echo ($is=='late')?'selected':'' ;?>>สาย</option>
                        <option value="leave" <?php echo ($is=='leave')?'selected':'' ;?>>ลา</option>
                        <option value="missing" <?php echo ($is=='missing')?'selected':'' ;?>>ขาด</option>
                    </select>
                </td>
                <td>
                    <input class="form-control check_list" type="text" attr_student_id="<?php echo $item['id']; ?>" name="detail" value="-">
                </td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>

        <div class="text-center pt-5">
            <button class="btn btn-success" onclick="saveChecked();">บันทึก</button>
        </div>

    </div>
</body>

<div class="modal fade modal-add-holiday" tabindex="-1" role="dialog" aria-labelledby="myModalEditHoliday" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มวันหยุด</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="input_add_holiday">วันที่</label>
                    <input id="input_add_holiday" class="form-control" name="holiday" type="date" value="<?php echo $UrlYMD; ?>">
                </div>
                <div class="form-group">
                    <label for="input_add_detail">รายละเอียด</label>
                    <input id="input_add_detail" class="form-control" name="detail" type="text" value="">
                </div>
            </div>

            <div class="modal-footer">
                <input name="fn" value="addHoliday" hidden>
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade " id="modal-edit-holiday" tabindex="-1" role="dialog" aria-labelledby="myModalEditHoliday" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <h5 class="modal-title">วันหยุด</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="input_edit_holiday">วันที่</label>
                    <input id="input_edit_holiday" class="form-control" name="holiday" type="date" value="<?php echo $UrlYMD; ?>">
                </div>
                <div class="form-group">
                    <label for="input_edit_detail">รายละเอียด</label>
                    <input id="input_edit_detail" class="form-control" name="detail" type="text" value="">
                </div>



            </div>

            <div class="modal-footer">
                <input id="input_holiday_id" name="holiday_id" value="" hidden>
                <input name="fn" value="editHoliday" hidden>
                <button type="button" class="btn btn-danger" onclick="modalDeleteHoliday()">ลบ</button>
                <button type="submit" class="btn btn-warning">บันทึก</button>
            </div>
        </form>
        <form class="deleteHoliday" method="post" hidden>
            <input id="delete_holiday_id" name="holiday_id" value="" hidden>
            <input name="fn" value="deleteHoliday" hidden>
            <button id="delete_holiday" type="submit" class="btn btn-warning">delete</button>
        </form>
    </div>
</div>


<div class="value-attr" hidden>
    <input id="input_year" value="<?php echo $UrlYear;?>">
    <input id="input_class" value="<?php echo $menuCheck;?>">
    <input id="input_ymd" value="<?php echo $UrlYMD;?>">
</div>





<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>

    <script>
        $(document).ready(function() {
            $('#table_check').DataTable({
                "lengthChange": false,
                "bInfo" : false,
                "iDisplayLength" : 100 ,
                "paging": false
            });
        } );

        function saveChecked() {

            var input_class = $('#input_class').val();
            var input_year = $('#input_year').val();
            var input_date = $('#input_ymd').val();
            var check_list = $('.check_list');

            var list_data = '';
            var student_id = '';
            var check = '';
            var note = '';
            for(var i=0;i<check_list.length;i++){
                note  = $(check_list[i]).val();
                student_id = $(check_list[i]).attr('attr_student_id');
                check = $('#check_'+student_id).val();
                if(i==0){
                    list_data += student_id+":"+check+":"+note;
                }else {
                    list_data += ","+student_id+":"+check+":"+note;
                }
            }


            var req = $.ajax({
                type: 'POST',
                url: './controller/service.php',
                data: {
                    fn: 'insertListCheck',
                    year: input_year,
                    list: list_data,
                    date: input_date
                },
                dataType: 'JSON'
            });
            req.done(function (res) {
                if(res.status){
                    alert('save data complete...');
                    document.location = "teacher_checkname.php?class="+input_class+"&year="+input_year+"&ymd="+input_date;
                }else{
                    alert('save data false!!!!');
                }
            });

        }

        function changeYMD() {
            var input_class = $('#input_class').val();
            var input_year = $('#input_year').val();
            var input_date = $('#select_ymd').val();
            document.location = "teacher_checkname.php?class="+input_class+"&year="+input_year+"&ymd="+input_date;
        }

        function changeY() {
            var input_class = $('#input_class').val();
            var input_year = $('#input_year').val();
            var input_date = $('#select_ymd').val();
            document.location = "teacher_checkname.php?class="+input_class+"&year="+input_year+"&ymd="+input_date;
        }

        function modalEditHoliday(srq) {
            var _this = $(srq);
            var id = $(_this).attr('attr_id');
            var day = $(_this).attr('attr_day');
            var detail = $(_this).attr('attr_detail');
            $('#input_edit_holiday').val(day);
            $('#input_edit_detail').val(detail);
            $('#input_holiday_id').val(id);
            $('#delete_holiday_id').val(id);

            $('#modal-edit-holiday').modal('show');
        }

        function modalDeleteHoliday() {
            $('#delete_holiday').click();
        }

    </script>
</footer>