<?php
require_once __DIR__.'/_session.php';


$menuAction = 'student';
$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : $SCHOOL_YEAR;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");

require_once __DIR__."/controller/aboutStudentController.php";
?>

<head>
    <?php include( __DIR__."/head.php"); ?>

</head>

<body class="fixed-nav sticky-footer bg-dark <?php echo $SESSION_user_id == 0 ?'sidenav-toggled':'';?>" id="page-top">
<!-- Navigation-->
<?php include( __DIR__."/memu.php"); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->
        <div class="mb-0 mt-4">
            <h4><i class="fa fa-group"></i> นักเรียน </h4>
        </div>
        <hr class="mt-2">

        <div class="form-inline" style="padding-left: 60%;">
            <div class="form-group mb-3">
                <label for="input_year"> ปีการศึกษา </label>
                <select class="form-control ml-2" id="input_year" name="year" onchange="selectYear(this);">
                    <?php for ($i=$year;$i>($year-10);$i--): ?>
                        <option value="<?php echo ($i);?>"  <?php echo $UrlYear==$i?'selected':'' ?>> <?php echo ($i+543); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>

        <div class="mb-5" style="padding-left: 20%;">
            <table id="table_student" class="table table-bordered table-hover" style="width:70%;">
                <thead>
                <tr class="table-secondary">
                    <th>ชั้น</th>
                    <th>ชาย</th>
                    <th>หญิง</th>
                    <th>รวม</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $sumF = 0;
                    $sumM = 0;
                ?>
                <?php foreach ($STUDENTS as $item): ?>
                    <?php
                        $c = $item['class'];
                        $cM = intval($item['sum_m']);
                        $cF = intval($item['sum_f']);
                        $sumFM = $cM+$cF;
                        $sumF = $sumF+$cF;
                        $sumM = $sumM+$cM;
                    ?>
                    <tr>
                        <td><?php echo $c;?></td>
                        <td><?php echo $cM;?></td>
                        <td><?php echo $cF;?></td>
                        <td><?php echo $sumFM;?></td>
                    </tr>
                <?php endforeach; ?>
                    <tr class="table-warning">
                        <td>รวม</td>
                        <td><?php echo $sumM;?></td>
                        <td><?php echo $sumF;?></td>
                        <td><?php echo $sumM+$sumF;?></td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>
</div>


</body>

<footer class="sticky-footer">
    <?php include( __DIR__."/footer.php"); ?>
</footer>

<script>
    function selectYear(res) {
        var input_year = res.value;
        document.location = "aboutStudent.php?year="+input_year;
    }
</script>
