<?php
require_once __DIR__."/_session.php";
require_once __DIR__ . "/_loginTeacher.php";

$menuAction = 'visiting';
$menuVisiting = isset($_REQUEST['class']) ? $_REQUEST['class'] : '';
$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : $SCHOOL_YEAR;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");

if($menuVisiting==10){
    $className = "อนุบาล 1";
}elseif ($menuVisiting==20){
    $className = "อนุบาล 2";
}else{
    $className = "ประถมศึกษาปีที่ " . $menuVisiting;
}


require_once __DIR__."/controller/teacherVisitingController.php";

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
        <li class="breadcrumb-item active">
            <a href="teacher_visiting.php?class=<?php echo $menuVisiting; ?>"><?php echo $className; ?> </a></li>
        <li class="breadcrumb-item active"> รายชื่อนักเรียน </li>
    </ol>

    <div class="text-right mr-5" style="padding-bottom: 20px;">
        ปีการศึกษา:
        <select id="input_year" name="year" onchange="selectYear(this);">
            <?php for ($i=$year;$i>($year-10);$i--): ?>
                <option value="<?php echo ($i);?>"  <?php echo $UrlYear==$i?'selected':'' ?>> <?php echo ($i+543); ?></option>
            <?php endfor; ?>
        </select>
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
                    <td>
                        <a href="teacher_visitinglist.php?uid=<?php echo $item['id']; ?>&class=<?php echo $menuVisiting;?>"><i class="fa fa-pencil"></i> edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>


    <div class="value-attr" hidden>
        <input id="input_year" value="<?php echo $UrlYear;?>">
        <input id="input_class" value="<?php echo $menuVisiting;?>">
    </div>


</div>


</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>

<script>
    $(document).ready(function() {
        $('#table_student').DataTable();
    } );

    function selectYear(res) {
        var input_year = res.value;
        var input_class = $('#input_class').val();
        document.location = "teacher_visiting.php?class="+input_class+"&year="+input_year;
    }

</script>