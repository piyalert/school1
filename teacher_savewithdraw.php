<?php
require_once __DIR__."/_session.php";
require_once __DIR__ . "/_loginTeacher.php";

$date = new DateTime();


$SAVELIST = [];
$menuAction = 'saving';
$menuSave = isset($_REQUEST['class']) ? $_REQUEST['class'] : 1;
$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : $SCHOOL_YEAR;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$UrlYMD = isset($_REQUEST['ymd']) ? dayTTE($_REQUEST['ymd']) : $date->format('Y-m-d');

require_once __DIR__."/controller/teacherSaveWithdrawController.php";

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
            <a class="nav-link " href="teacher_savelist.php?class=<?php echo $menuSave; ?>">ยอดรวม</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="teacher_savedeposit.php?class=<?php echo $menuSave; ?>">ฝากเงิน</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="teacher_savewithdraw.php?class=<?php echo $menuSave; ?>">ถอนเงิน</a>
        </li>
    </ul>

    <div class="form-inline">
        <div class="form-group ml-5">
            <label class="mr-3" for="input_ymd"> วันที่ถอนเงิน </label>
            <input class="datepicker form-control" id="input_ymd" name="input_ymd" type="text" value="<?php echo formatDate($UrlYMD); ?>" onchange="changeYMDWithdraw();">
        </div>
    </div>

    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->

        <table id="table_saving" class="table table-striped table-bordered" style="width:100%;">
            <thead style="font-size: 12px;">
            <tr>
                <th>#</th>
                <th>ชื่อ - สกุล</th>
                <th>ยอดเงินถอนได้</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($SAVELIST as $key=>$item): ?>
                <tr>
                    <td><?php echo ($key+1);?></td>
                    <td>
                        <a href="teacher_savesearch.php?id=<?php echo $item['id'];?>">
                            <?php echo $item['name'].' '.$item['surname'];?>
                        </a>
                    </td>
                    <td><?php echo ($item['sum_deposit'] - $item['sum_withdraw']);?></td>
                    <td>
                        <button class="btn btn-link" role="button" style="color: red;"
                        attr_user_id="<?php echo $item['id'] ;?>"
                        attr_name="<?php echo $item['name'].' '.$item['surname'];?>"
                        attr_balance="<?php echo ($item['sum_deposit'] - $item['sum_withdraw']);?>"
                        onclick="showModalWithdraw(this);">
                            <i class="fa fa-credit-card"></i> ถอนเงิน
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>

        <div class="value-attr" hidden>
            <input id="input_year" value="<?php echo $UrlYear;?>">
            <input id="input_class" value="<?php echo $menuSave;?>">
            <input id="input_login_user_id" value="<?php echo $SESSION_user_id;?>">
        </div>

    </div>

</body>

<div class="modal fade" id="modalWithdraw" tabindex="-1" role="dialog" aria-labelledby="modalWithdraw"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ต้องการออกจากระบบ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong id="modal_name">มานะ ใจดี</strong> ยอดถอนได้ <strong id="modal_balance" style="color: red;"> 20 </strong></p>
                <input id="input_balance" class="form-control" type="number" name="withdraw" value="" min="1" max="20" onchange="checkWithdrawValue();" required>
                <p id="modal_error" style="color: red;" hidden>Error message</p>
                <br>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="checkWithdraw" onchange="checkWithdrawClick();" disabled >
                    <label class="form-check-label" for="defaultCheck2">
                        ยืนยันการถอนเงิน
                    </label>
                </div>

            </div>
            <div class="modal-footer">
                <input name="fn" value="withdraw" hidden>
                <input id="user_id" name="user_id" value="" hidden>
                <button id="button_withdraw" class="btn btn-danger" type="submit" disabled>ถอนเงิน</button>
            </div>
        </form>
    </div>
</div>

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

    function showModalWithdraw(res) {
        $('#modal_error').removeAttr('hidden');
        $('#modal_error').html("กรุณากรอกยอดเงินที่ต้องการถอน");
        $('#checkWithdraw').attr('disabled','');
        $('#checkWithdraw').prop("checked", false);
        $('#button_withdraw').attr('disabled','');
        $('#input_balance').val('');

        var name = $(res).attr('attr_name');
        var balance = $(res).attr('attr_balance');
        var user_id = $(res).attr('attr_user_id');

        $('#modal_name').html(name);
        $('#modal_balance').html(balance);
        $('#input_balance').attr('max',balance);
        $('#user_id').attr('value',user_id);

        $('#modalWithdraw').modal();
    }
    function changeYMDWithdraw() {
        var input_class = $('#input_class').val();
        var input_year = $('#input_year').val();
        var ymd = $('#input_ymd').val();
        document.location = "teacher_savewithdraw.php?class="+input_class+"&year="+input_year+"&ymd="+ymd;
    }
    function checkWithdrawValue() {
        var max = $('#input_balance').attr('max');
        var balance = $('#input_balance').val();
        if(balance=='0') {
            $('#modal_error').removeAttr('hidden');
            $('#modal_error').html("กรุณากรอกยอดเงินที่ต้องการถอน!!!");
            $('#checkWithdraw').attr('disabled','');
            $('#checkWithdraw').prop("checked", false);
            $('#button_withdraw').attr('disabled','');
            $('#input_balance').val('');
        }else if(parseInt(balance) > parseInt(max)){
            $('#modal_error').removeAttr('hidden');
            $('#modal_error').html("ยอดเงินที่ต้องการถอนมากว่ายอดเงินที่มีอยู่");
            $('#checkWithdraw').attr('disabled','');
            $('#checkWithdraw').prop("checked", false);
            $('#button_withdraw').attr('disabled','');
            $('#input_balance').val('');
        }else{
            $('#modal_error').attr('hidden','');
            $('#checkWithdraw').removeAttr('disabled','');
        }
    }
    function checkWithdrawClick() {
        var check = document.getElementById('checkWithdraw').checked;
        if(check==true){
            $('#button_withdraw').removeAttr('disabled','');
        }else{
            $('#button_withdraw').attr('disabled','');
        }

    }

</script>


