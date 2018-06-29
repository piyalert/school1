<?php
date_default_timezone_set("Asia/Bangkok");


$menuAction = 'class';
$menuClass = isset($_REQUEST['class']) ? $_REQUEST['class'] : '';
$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : 2561;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");

$className = "ประถมศึกษาปีที่ " . $menuClass;

require_once __DIR__."/controller/teacherClassController.php";

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
        <li class="breadcrumb-item active"> รายชื่อนักเรียน</li>
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
            <i class="fa fa-plus"></i> เพิ่มนักเรียน
        </button>
    </div>

    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->
        <table id="table_student" class="table table-striped table-bordered" style="width:100%;">
            <thead style="font-size: 12px;">
            <tr>
                <th>#</th>
                <th>เพศ</th>
                <th>ชื่อ สกุล</th>
                <th>รหัสบัตรประจำตัวประชาชน</th>
                <th>วันเกิด</th>
                <th>ผู้ปกครอง</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($STUDENTLISTS as $item): ?>
                <tr>
                    <td><?php echo $item['id'];?></td>
                    <td><?php echo $item['gender'];?></td>
                    <td><?php echo $item['name'].' '.$item['surname'];?></td>
                    <td><?php echo $item['id_card'];?></td>
                    <td><?php echo $item['birthday'];?></td>
                    <td><?php echo $item['parent'];?></td>
                    <td>
                        <div class="form-inline">
                            <div class="mb-2">
                                <button class="btn btn-link" data-toggle="modal" data-target=".bd-modal-parent"
                                        attr_parent="<?php echo $item['parent'];?>" attr_student_id="<?php echo $item['student_id'];?>"
                                        onclick="editParent(this);" >
                                    <i class="fa fa-pencil"></i> edit
                                </button>
                            </div>
                            <form class="mb-2" method="post">
                                <input name="student_id" value="<?php echo $item['student_id'];?>" hidden>
                                <input name="fn" value="deleteStudent" hidden>
                                <button class="btn btn-link" style="color: red;" type="submit">
                                    <i class="fa fa-pencil"></i> delete
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>


    <div class="value-attr" hidden>
        <input id="input_year" value="<?php echo $UrlYear;?>">
        <input id="input_class" value="<?php echo $menuClass;?>">
    </div>


</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รายชื่อสมาชิก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table id="table_user" class="table table-striped table-bordered" style="width:100%;">
                    <thead style="font-size: 12px;">
                    <tr>
                        <th>#</th>
                        <th>เพศ</th>
                        <th>ชื่อ สกุล</th>
                        <th>ผุ้ปกครอง</th>
                        <th>วันเกิด</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($USERLISTS as $item): ?>
                        <tr>
                            <td>
                                <input type="checkbox" aria-label="select" value="<?php echo $item['id'];?>" onchange="selectUser(this)">
                            </td>
                            <td><?php echo $item['gender'];?></td>
                            <td><?php echo $item['name'].' '.$item['surname'];?></td>
                            <td><?php echo $item['id_card'];?></td>
                            <td><?php echo $item['birthday'];?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <input id="input_list_user_id" attr_list=""  hidden>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addStudent();">เพิ่มนักเรียน</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade bd-modal-parent" tabindex="-1" role="dialog" aria-labelledby="myModalParent" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <h5 class="modal-title">ผู้ปกครอง</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input id="input_parent" class="form-control" name="parent" value="">
            </div>

            <div class="modal-footer">
                <input id="input_student_id" name="student_id" value="" hidden>
                <input name="fn" value="editParent" hidden>
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
        </form>
    </div>
</div>

</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>

<script>
    $(document).ready(function() {
        $('#table_student').DataTable();
        $('#table_user').DataTable();
    } );

    function selectUser(res) {
        var user_id = res.value;
        var list_user = $('#input_list_user_id').attr("attr_list");
        if(list_user.length <= 0){
            $('#input_list_user_id').attr("attr_list",user_id);
        }else{

            var arr_user = list_user.split(",");
            var check = true;
            list_user = "";
            for (var i=0;i<arr_user.length;i++){
                if( user_id == arr_user[i] ){
                    check = false;
                }else {
                    if(list_user.length==0){
                        list_user = arr_user[i];
                    }else{
                        list_user = list_user+","+arr_user[i];
                    }
                }
            }
            if(check){
                list_user = list_user+","+user_id;
            }

            $('#input_list_user_id').attr("attr_list",list_user);
        }

    }

    function addStudent() {
        var list_user_id  = $('#input_list_user_id').attr("attr_list");
        var input_year = $('#input_year').val();
        var input_class = $('#input_class').val();

        var req = $.ajax({
            type: 'POST',
            url: './controller/service.php',
            data: {
                fn: 'insertStudent',
                list_user_id: list_user_id,
                class: input_class,
                year: input_year,
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                alert('save data complete...');
                document.location = "teacher_class.php?class="+input_class+"&year="+input_year;
            }else{
                alert('save data false!!!!');
            }
        });
    }

    function selectYear(res) {
        var input_year = res.value;
        var input_class = $('#input_class').val();
        document.location = "teacher_class.php?class="+input_class+"&year="+input_year;
    }

    function editParent(res) {
        var parent = $(res).attr("attr_parent");
        var student_id = $(res).attr("attr_student_id");
        $('#input_student_id').attr("value",student_id);
        $('#input_parent').val(parent);
    }

</script>