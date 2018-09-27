<?php
require_once __DIR__.'/_session.php';
require_once __DIR__ . "/_loginStudent.php";

$SAVELIST = [];
$menuAction = 'saving';
$user_id = $SESSION_user_id;

require_once __DIR__."/controller/userSaveController.php";

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
            <h2><i class="fa fa-money"></i> เงินออม </h2></div>
        <hr class="mt-2">

        <!-- Card Columns Example Social Feed-->

        <div class="alert alert-dark" role="alert">
            ยอดฝาก : ( <strong class="text-success"><?=$DEPOSIT;?></strong> )
            ยอดถอน : ( <strong class="text-danger"><?=$WITHDRAW;?></strong> )
            คงเหลือ : ( <strong class="text-primary"><?=($DEPOSIT-$WITHDRAW);?></strong> )
        </div>


        <table id="table_saving" class="table table-striped table-bordered" style="width:100%;">
            <thead style="font-size: 12px;">
            <tr>
                <th>#</th>
                <th>เวลา</th>
                <th>ฝาก/ถอน</th>
                <th>ยอดฝาก/ถอน</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($SAVELIST as $key=>$item): ?>
                <tr>
                    <td><?php echo ($key+1);?></td>
                    <td><?php echo $item['date_at'];?></td>
                    <td class="<?php echo $item['event']=='deposit'?'table-success':'table-danger';?>"><?php echo $item['event']=='deposit'?'ฝาก':'ถอน';?></td>
                    <td><?php echo $item['balance'];?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>


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


</script>


