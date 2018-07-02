<?php
date_default_timezone_set("Asia/Bangkok");


$SAVELIST = [];
$menuAction = 'saving';
$menuSave = isset($_REQUEST['class']) ? $_REQUEST['class'] : 1;
$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : 2561;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");

$DAYName = ['-','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์','อาทิตย์'];

$date = new DateTime();
$interval = new DateInterval('P1D');

$d5_day = $DAYName[$date->format('N')];
$d5_ymd = $date->format('Y-m-d');

$date1 = $date->sub($interval);
$d4_day = $DAYName[$date->format('N')];
$d4_ymd = $date->format('Y-m-d');

$date1 = $date->sub($interval);
$d3_day = $DAYName[$date->format('N')];
$d3_ymd = $date->format('Y-m-d');

$date1 = $date->sub($interval);
$d2_day = $DAYName[$date->format('N')];
$d2_ymd = $date->format('Y-m-d');

$date1 = $date->sub($interval);
$d1_day = $DAYName[$date->format('N')];
$d1_ymd = $date->format('Y-m-d');


require_once __DIR__."/controller/teacherSaveListController.php";

?>


<head>
    <?php include(__DIR__ . "/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>

<div class="content-wrapper">

    <ul class="nav nav-pills breadcrumb">
        <li class="nav-item">
            <a class="nav-link " href="teacher_savelist.php">ยอดรวม</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="teacher_savedeposit.php">ฝากเงิน</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="teacher_savewithdraw.php">ถอนเงิน</a>
        </li>
    </ul>

    <div class="form-inline">
        <div class="form-group mb-5 ml-5">
            <label for="input_year"> ปีการศึกษา </label>
            <select class="form-control" id="input_year" name="year" onchange="selectYear(this);">
                <?php for ($i=$year;$i>($year-10);$i--): ?>
                    <option value="<?php echo ($i);?>"  <?php echo $UrlYear==$i?'selected':'' ?>> <?php echo ($i+543); ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->

        <table id="table_saving" class="table table-striped table-bordered" style="width:100%;">
            <thead style="font-size: 12px;">
            <tr>
                <th>#</th>
                <th>ชื่อ - สกุล</th>
                <th>ปีการศึกษา</th>
                <th>ระดับชั่น</th>
                <th><?php echo "($d1_day)$d1_ymd" ;?></th>
                <th><?php echo "($d2_day)$d2_ymd" ;?></th>
                <th><?php echo "($d3_day)$d3_ymd" ;?></th>
                <th><?php echo "($d4_day)$d4_ymd" ;?></th>
                <th><?php echo "($d5_day)$d5_ymd" ;?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($SAVELIST as $item): ?>
                <tr>
                    <td><?php echo $item['id'];?></td>
                    <td><?php echo $item['name'].' '.$item['surname'];?></td>
                    <td><?php echo $item['year'];?></td>
                    <td><?php echo $item['class'];?></td>
                    <td>xx</td>
                    <td>xx</td>
                    <td>xx</td>
                    <td>xx</td>
                    <td>xx</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="value-attr" hidden>
            <input id="input_year" value="<?php echo $UrlYear;?>">
            <input id="input_class" value="<?php echo $menuSave;?>">
        </div>

    </div>

</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>

<script>

    $(document).ready(function() {
        $('#table_saving').DataTable({
            "lengthChange": false,
            "bInfo" : false,
            "iDisplayLength" : 50
        });
    } );


    function selectYear(res) {
        var input_year = res.value;
        var input_class = $('#input_class').val();
        document.location = "teacher_savelist.php?class="+input_class+"&year="+input_year;
    }


</script>

