<?php
require_once __DIR__."/_session.php";
require_once __DIR__ . "/_loginTeacher.php";

$date = new DateTime();

$SAVELIST = [];
$menuAction = 'saving';
$menuSave = isset($_REQUEST['class']) ? $_REQUEST['class'] : 1;
$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : $SCHOOL_YEAR;
$UrlYMD = isset($_REQUEST['ymd']) ? $_REQUEST['ymd'] : $date->format('Y-m-d');

$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");

$DAYName = ['-','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์','อาทิตย์'];

//$date = new DateTime();
//$interval = new DateInterval('P1D');
//$this_day = $DAYName[$date->format('N')];
//$this_ymd = $date->format('Y-m-d');
//$date1 = $date->sub($interval);
//$d4_day = $DAYName[$date->format('N')];
//$d4_ymd = $date->format('Y-m-d');



require_once __DIR__."/controller/teacherSaveDepositController.php";

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
            <a class="nav-link active" href="teacher_savedeposit.php?class=<?php echo $menuSave; ?>">ฝากเงิน</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="teacher_savewithdraw.php?class=<?php echo $menuSave; ?>">ถอนเงิน</a>
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
            <input class="form-control" id="input_ymd" name="input_ymd" type="date" value="<?php echo $UrlYMD; ?>" onchange="changeYMDDeposit();">
        </div>
    </div>

    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->

        <table id="table_saving" class="table table-striped table-bordered" style="width:100%;">
            <thead style="font-size: 12px;">
            <tr>
                <th>#</th>
                <th>ชื่อ - สกุล</th>
                <th id="deposit_ymd"><?php echo $UrlYMD ;?></th>
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
                    <td style="width: 120px;">
                        <input class="form-control input-deposit" attr_user_id="<?php echo $item['id']; ?>" type="number" value="<?php echo $item['balance'];?>">
                    </td>
                    <td>
                        <a class="btn btn-link" role="button" href="teacher_savesearch.php?id=<?php echo $item['id'];?>" style="color: #DF7401;">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>

        <div class="text-center">
            <button class="btn btn-success" onclick="saveDeposit();">Save</button>
            <button class="btn btn-danger" onclick="clearDeposit();">Clear</button>
        </div>

        <div class="value-attr" hidden>
            <input id="input_year" value="<?php echo $UrlYear;?>">
            <input id="input_class" value="<?php echo $menuSave;?>">
            <input id="input_login_user_id" value="<?php echo $SESSION_user_id;?>">
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
        var input_class = $('#input_class').val();
        var input_year = $('#input_year').val();
        var ymd = $('#input_ymd').val();
        document.location = "teacher_savedeposit.php?class="+input_class+"&year="+input_year+"&ymd="+ymd;
    }

    function clearDeposit() {
        $('.input-deposit').val('');
    }

    function saveDeposit() {
        var deposit = $('.input-deposit');
        var input_class = $('#input_class').val();
        var input_year = $('#input_year').val();
        var date = $('#deposit_ymd').text();
        var input_user_login = $('#input_login_user_id').val();

        var list_data = '';
        var user_id = '';
        var balance = '';
        for(var i=0;i<deposit.length;i++){
            balance  = $(deposit[i]).val();
            user_id = $(deposit[i]).attr('attr_user_id');
            if(balance.length>0){
                if(i==0){
                    list_data += user_id+":"+balance;
                }else {
                    list_data += ","+user_id+":"+balance;
                }
            }
        }

        var req = $.ajax({
            type: 'POST',
            url: './controller/service.php',
            data: {
                fn: 'insertListSaving',
                active_user: input_user_login,
                year: input_year,
                list: list_data,
                date: date
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                alert('save data complete...');
                document.location = "teacher_savedeposit.php?class="+input_class+"&year="+input_year+"&ymd="+date;
            }else{
                alert('save data false!!!!');
            }
        });

    }


</script>


