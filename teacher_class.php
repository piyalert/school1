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
        <select id="input_year" name="year">
            <?php for ($i=$year;$i>($year-10);$i--): ?>
                <option value="<?php echo ($i);?>"> <?php echo ($i+543); ?></option>
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
                        <a href="news_edit.php?id=<?php echo $item['id'];?>">
                            <i class="fa fa-pencil"></i> edit
                        </a>
                        <a href="news.php?fn=delete&id=<?php echo $item['id'];?>" style="padding-left: 20px; color: red;">
                            <i class="fa fa-pencil"></i> delete
                        </a>
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
                            <td><input type="radio" aria-label="select"></td>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">เพิ่มนักเรียน</button>
            </div>

        </div>
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

</script>