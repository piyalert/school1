<?php
require_once __DIR__."/_session.php";
require_once __DIR__ . "/_loginTeacher.php";

$menuAction = 'course';
$menuCourse = isset($_REQUEST['class']) ? $_REQUEST['class'] : '';
$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : $SCHOOL_YEAR;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");

if($menuCourse>=10){
    $className = "อนุบาล ".($menuCourse/10);
}else{
    $className = "ประถมศึกษาปีที่ " . $menuCourse;
}

require_once __DIR__."/controller/teacherCourseController.php";

?>

<head>
    <?php include(__DIR__ . "/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>

<div class="content-wrapper">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a
                href="teacher_class.php?class=<?php echo $menuClass; ?>"><?php echo $className; ?></a></li>
        <li class="breadcrumb-item active"> รายวิชาที่เปิดสอน</li>
    </ol>

    <div class="text-right mr-5" style="padding-bottom: 20px;">
        ปีการศึกษา:
        <select id="input_year" name="year" onchange="selectYear(this);">
            <?php for ($i=$year;$i>($year-10);$i--): ?>
                <option value="<?php echo ($i);?>"  <?php echo $UrlYear==$i?'selected':'' ?>> <?php echo ($i+543); ?></option>
            <?php endfor; ?>
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">
            <i class="fa fa-plus"></i> เพิ่มรายวิชา
        </button>
    </div>

    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->
        <table id="table_course" class="table table-striped table-bordered" style="width:100%;">
            <thead style="font-size: 12px;">
            <tr>
                <th>#</th>
                <th>รหัสวิชา</th>
                <th>วิชา</th>
                <th>รายละเอียด</th>
                <th>ปีการศึกษา</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($COURSELIST as $key=>$item): ?>
                <tr>
                    <td><?php echo ($key+1); ?></td>
                    <td><?php echo $item['code'];?></td>
                    <td><?php echo $item['name'];?></td>
                    <td><?php echo $item['detail'];?></td>
                    <td><?php echo $item['year'];?></td>
                    <td>
                        <button class="btn btn-link btn-sm text-danger"  onclick="setModalDelete('deleteCourse','<?php echo $item['name']; ?>','<?php echo $item['id']; ?>');">
                            <i class="fa fa-trash"></i> delete
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>


    <div class="value-attr" hidden>
        <input id="input_year" value="<?php echo $UrlYear;?>">
        <input id="input_class" value="<?php echo $menuCourse;?>">
    </div>


</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รายวิชา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table id="table_subject" class="table table-striped table-bordered" style="width:100%;">
                    <thead style="font-size: 12px;">
                    <tr>
                        <th>#</th>
                        <th>ราวิชา</th>
                        <th>รายละเอียด</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($SUBJECTLIST as $item): ?>
                        <tr>
                            <td>
                                <input type="checkbox" aria-label="select" value="<?php echo $item['id'];?>" onchange="selectSub(this)">
                            </td>
                            <td><?php echo $item['name'];?></td>
                            <td><?php echo $item['detail'];?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <input id="input_list_sub_id" attr_list=""  hidden>
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addCourse();">เพิ่มรายวิชา</button>
            </div>

        </div>
    </div>
</div>

</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>

<?php include(__DIR__.'/_modalDeleteConfirm.php');?>

<script>
    $(document).ready(function() {
        $('#table_course').DataTable();
        $('#table_subject').DataTable();
    } );

    function selectSub(res) {
        var sub_id = res.value;
        var list_sub = $('#input_list_sub_id').attr("attr_list");
        if(list_sub.length <= 0){
            $('#input_list_sub_id').attr("attr_list",sub_id);
        }else{

            var arr_sub = list_sub.split(",");
            var check = true;
            list_sub = "";
            for (var i=0;i<arr_sub.length;i++){
                if( sub_id == arr_sub[i] ){
                    check = false;
                }else {
                    if(list_sub.length==0){
                        list_sub = arr_sub[i];
                    }else{
                        list_sub = list_sub+","+arr_sub[i];
                    }
                }
            }
            if(check){
                list_sub = list_sub+","+sub_id;
            }

            $('#input_list_sub_id').attr("attr_list",list_sub);
        }

    }

    function addCourse() {
        var list_sub_id  = $('#input_list_sub_id').attr("attr_list");
        var input_year = $('#input_year').val();
        var input_class = $('#input_class').val();

        var req = $.ajax({
            type: 'POST',
            url: './controller/service.php',
            data: {
                fn: 'insertCourseList',
                list_sub_id: list_sub_id,
                class: input_class,
                year: input_year,
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                alert('save data complete...');
                document.location = "teacher_course.php?class="+input_class+"&year="+input_year;
            }else{
                alert('save data false!!!!');
            }
        });
    }

    function selectYear(res) {
        var input_year = res.value;
        var input_class = $('#input_class').val();
        document.location = "teacher_course.php?class="+input_class+"&year="+input_year;
    }

</script>

