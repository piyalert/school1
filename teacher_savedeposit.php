<?php
require_once __DIR__."/_session.php";


$SAVELIST = [];
$menuAction = 'saving';
$menuSave = isset($_REQUEST['class']) ? $_REQUEST['class'] : 1;
$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : 2561;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");

$DAYName = ['-','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์','อาทิตย์'];

$date = new DateTime();
$interval = new DateInterval('P1D');

$this_day = $DAYName[$date->format('N')];
$this_ymd = $date->format('Y-m-d');

//$date1 = $date->sub($interval);
//$d4_day = $DAYName[$date->format('N')];
//$d4_ymd = $date->format('Y-m-d');



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
        <div class="form-group ml-5">
            <label class="mr-3" for="input_year"> ปีการศึกษา </label>
            <select class="form-control" id="input_year" name="year" onchange="selectYear(this);">
                <?php for ($i=$year;$i>($year-10);$i--): ?>
                    <option value="<?php echo ($i);?>"  <?php echo $UrlYear==$i?'selected':'' ?>> <?php echo ($i+543); ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="form-group ml-5">
            <label class="mr-3" for="input_ymd"> วันที่ฝากเงิน </label>
            <input class="form-control" id="input_ymd" name="input_ymd" type="date" value="<?php echo $this_ymd; ?>" onchange="changeYMDDeposit();">
        </div>
    </div>

    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->

        <table id="table_saving" class="table table-striped table-bordered" style="width:100%;">
            <thead style="font-size: 12px;">
            <tr>
                <th>#</th>
                <th>ชื่อ - สกุล</th>
                <th id="deposit_ymd"><?php echo $this_ymd ;?></th>
                <th>ปีการศึกษา</th>
                <th>ระดับชั่น</th>
                <th>วันที่ฝากล่าสุด</th>
                <th>เงินฝากล่าสุด</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($SAVELIST as $key=>$item): ?>
                <tr>
                    <td><?php echo ($key+1);?></td>
                    <td><?php echo $item['name'].' '.$item['surname'];?></td>
                    <td style="width: 120px;">
                        <input class="form-control" type="number" value="">
                    </td>
                    <td><?php echo $item['year'];?></td>
                    <td><?php echo $item['class'];?></td>
                    <td>2018-05-10</td>
                    <td>23</td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>

        <div class="text-center">
            <button class="btn btn-success">Save</button>
        </div>

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
            "bPaginate":false,
            "iDisplayLength" : 100
        });
    } );


    function selectYear(res) {
        var input_year = res.value;
        var input_class = $('#input_class').val();
        document.location = "teacher_savedeposit.php?class="+input_class+"&year="+input_year;
    }

    function changeYMDDeposit() {
        var ymd = $('#input_ymd').val();
        $('#deposit_ymd').html(ymd);
    }


</script>


