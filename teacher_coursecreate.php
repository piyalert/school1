<?php
require_once __DIR__."/_session.php";


$menuAction = 'course';
$menuCourse = 'create';


require_once __DIR__."/controller/teacherCourseCreateController.php";

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
        <li class="breadcrumb-item active"><a href="teacher_createcourse.php">รายวิชา</a></li>
        <li class="breadcrumb-item">รายวิชาที่เปิดสอนทั้งหมด</li>
    </ol>

    <div class="container-fluid">

        <table id="table_subject" class="table table-striped table-bordered" style="width:100%;">
            <thead style="font-size: 12px;">
            <tr>
                <th>วิชา</th>
                <th>รายละเอียด</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($SUBLIST as $item): ?>
                <tr>
                    <td><?php echo $item['name'];?></td>
                    <td><?php echo $item['detail'];?></td>
                    <td>
                        <div class="form-inline">

                            <div class="mb-2">
                                <button class="btn btn-link" data-toggle="modal" data-target=".bd-modal-edit-course"
                                        attr_name="<?php echo $item['name'];?>" attr_id="<?php echo $item['id'];?>"
                                        attr_detail="<?php echo $item['detail'];?>" onclick="editCourse(this);" >
                                    <i class="fa fa-pencil"></i> edit
                                </button>
                            </div>

                            <form class="mb-2" method="post">
                                <input name="course_id" value="<?php echo $item['id'];?>" hidden>
                                <input name="fn" value="removeCourse" hidden>
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


</div>



<div class="modal fade bd-modal-create-course" tabindex="-1" role="dialog" aria-labelledby="myModalParent" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มรายวิชา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="input_add_subject_name">รายวิชา</label>
                    <input type="text" name="name" class="form-control" id="input_add_subject_name" placeholder="ชื่อวิชา,ชื่อย่อ">
                </div>
                <div class="form-group">
                    <label for="input_add_subject_detail">รายละเอียดวิชา</label>
                    <input type="text" name="detail" class="form-control" id="input_add_subject_detail" placeholder="รายละเอียดวิชา,ชื่อเต็ม">
                </div>
            </div>

            <div class="modal-footer">
                <input name="fn" value="addCourse" hidden>
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade bd-modal-edit-course" tabindex="-1" role="dialog" aria-labelledby="myModalParent" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขรายวิชา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="input_edit_subject_name">รายวิชา</label>
                    <input type="text" name="name" class="form-control" id="input_edit_subject_name" placeholder="ชื่อวิชา,ชื่อย่อ">
                </div>
                <div class="form-group">
                    <label for="input_edit_subject_detail">รายละเอียดวิชา</label>
                    <input type="text" name="detail" class="form-control" id="input_edit_subject_detail" placeholder="รายละเอียดวิชา,ชื่อเต็ม">
                </div>
            </div>

            <div class="modal-footer">
                <input id="course_id" name="course_id" value="" hidden>
                <input name="fn" value="editCourse" hidden>
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
        $('#table_subject').DataTable();
    } );

    function editCourse(res) {
        var name = $(res).attr("attr_name");
        var detail = $(res).attr("attr_detail");
        var attr_id = $(res).attr("attr_id");

        $('#input_edit_subject_name').val(name);
        $('#input_edit_subject_detail').val(detail);
        $('#course_id').attr('value',attr_id);

    }

</script>