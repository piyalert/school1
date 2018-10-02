<?php
require_once __DIR__.'/_session.php';
require_once __DIR__ . "/_loginTeacher.php";

$date = new DateTime();

$menuAction = 'grade';
$menuGrade = isset($_REQUEST['class']) ? $_REQUEST['class'] : 1;

$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : $SCHOOL_YEAR;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");

if ($menuGrade == 10) {
    $className = "อนุบาล 1";
} elseif ($menuGrade == 20) {
    $className = "อนุบาล 2";
} else {
    $className = "ชั้นประถมศึกษาปีที่ " . $menuGrade;
}


require_once __DIR__."/controller/teacherScoreController.php";

?>


<head>
    <?php include(__DIR__ . "/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>

<div class="content-wrapper">
    <div class="container-fluid">

        <div class="mb-0 mt-4">
            <h2><i class="fa fa-calculator"></i> เกรด <small> <?php echo $className; ?> </small> </h2></div>
        <hr class="mt-2">

        <div class="form-inline mb-5">
            <div class="form-group ml-5">
                <label class="mr-3" for="input_year" > ปีการศึกษา </label>
                <select class="form-control" name="year" onchange="selectYear(this);">
                    <?php for ($i=$year;$i>($year-10);$i--): ?>
                        <option value="<?php echo ($i);?>"  <?php echo $UrlYear==$i?'selected':'' ?>> <?php echo ($i+543); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>

        <!-- Card Columns Example Social Feed-->
        <table class="table table-striped table-bordered dataTable" style="width:100%;">
            <thead style="font-size: 12px;">
            <tr>
                <th>#</th>
                <th>ชื่อ สกุล</th>
                <?php foreach ($HEADER as $item): ?>
                    <th><?=$item['name']?></th>
                <?php endforeach; ?>
                <th>GPA</th>
                <th>อันดับ</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($STUDENT as $key=>$item): ?>
                <tr>
                    <td><?php echo ($key+1);?></td>
                    <td><?php echo $item['name'].' '.$item['surname'];?></td>

                    <?php foreach ($item['grade'] as $i): ?>
                        <th><?php echo $i['score'];?> <small> <?php echo $i['final_exam']==''?'':'('.$i['final_exam'].')';?> </small></th>
                    <?php endforeach; ?>
                    <td>
                        <?php echo is_numeric($item['gpa'])?number_format($item['gpa'],2,'.',','):'';?>
                    </td>
                    <td>
                        <?php echo is_numeric($item['gpa'])?$item['seq']:''; ?>
                    </td>

                    <td>
                        <a href="teacher_score_edit.php?sid=<?php echo $item['id'];?>&y=<?php echo $item['year'];?>&c=<?php echo $item['class'];?>">
                            <i class="fa fa-pencil"></i> edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>


    </div>
</div>


</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>

<div class="value-attr" hidden>
    <input id="input_year" value="<?php echo $UrlYear;?>">
    <input id="input_class" value="<?php echo $menuGrade;?>">
</div>

<script>
    $(document).ready(function() {
        $('.dataTable').DataTable();
    } );

    function selectYear(res) {
        var input_year = res.value;
        var input_class = $('#input_class').val();
        document.location = "teacher_score.php?class="+input_class+"&year="+input_year;
    }


</script>
