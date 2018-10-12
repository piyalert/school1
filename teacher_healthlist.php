<?php
require_once __DIR__."/_session.php";
require_once __DIR__ . "/_loginTeacher.php";

$menuAction = 'health';
$menuHealth = isset($_REQUEST['class']) ? $_REQUEST['class'] : '';

if($menuHealth==10){
    $className = "อนุบาล 1";
}elseif ($menuHealth==20){
    $className = "อนุบาล 2";
}else{
    $className = "ประถมศึกษาปีที่ " . $menuHealth;
}


require_once __DIR__."/controller/teacherHealthListController.php";

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
            <a href="teacher_health.php?class=<?php echo $menuHealth; ?>"><?php echo $className; ?> </a></li>
        <li class="breadcrumb-item active"> <?php echo $USER_NAME; ?> <small>(<?php echo $USER_USERNAME; ?>)</small> </li>
    </ol>

    <div class="pl-2">
        <h4>ตรวจสุขภาพ</h4>
    </div>
    <hr>


    <div class="text-right mr-5" style="padding-bottom: 20px;">
        <a type="button" class="btn btn-success" href="teacher_healthEdit.php?id=0&class=<?php echo $menuHealth;?>&uid=<?php echo $user_id;?>">
            <i class="fa fa-plus"></i> เพิ่มการตรวจสุขภาพ
        </a>
    </div>

    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->
        <table id="table_student" class="table table-striped table-bordered" style="width:100%;">
            <thead style="font-size: 12px;">
            <tr>
                <th>#</th>
                <th>วันที่</th>
                <th>หัวเรื่อง</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($VISITINGS as $key=>$item): ?>
                <tr>
                    <td><?php echo ($key+1);?></td>
                    <td><?php echo date('d/m/Y',strtotime($item['date_at']));?></td>
                    <td><?php echo $item['title'];?></td>
                    <td>
                        <a href="teacher_healthEdit.php?id=<?php echo $item['id'];?>&class=<?php echo $menuHealth;?>&uid=<?php echo $user_id;?>"><i class="fa fa-pencil"></i> edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>


    <div class="value-attr" hidden>
        <input id="input_year" value="<?php echo $UrlYear;?>">
        <input id="input_class" value="<?php echo $menuHealth;?>">
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

</script>