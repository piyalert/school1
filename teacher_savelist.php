<?php
require_once __DIR__.'/_session.php';

$SAVELIST = [];
$menuAction = 'saving';
$menuSave = isset($_REQUEST['class']) ? $_REQUEST['class'] : 1;
$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : 2561;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");

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
            <a class="nav-link active" href="teacher_savelist.php?class=<?php echo $menuSave; ?>">ยอดรวม</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="teacher_savedeposit.php?class=<?php echo $menuSave; ?>">ฝากเงิน</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="teacher_savewithdraw.php?class=<?php echo $menuSave; ?>">ถอนเงิน</a>
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
                <th>ยอดฝาก</th>
                <th>ยอดถอน</th>
                <th>ยอดคงเหลือ</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($SAVELIST as $item): ?>
                <tr>
                    <td><?php echo $item['id'];?></td>
                    <td>
                        <a href="teacher_savesearch.php?id=<?php echo $item['id'];?>">
                        <?php echo $item['name'].' '.$item['surname'];?>
                        </a>
                    </td>
                    <td><?php echo $item['sum_deposit'];?></td>
                    <td><?php echo $item['sum_withdraw'];?></td>
                    <td><?php echo $item['sum_deposit']-$item['sum_withdraw'];?></td>
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


