<?php
require_once __DIR__ . "/_session.php";

$menuAction = 'home';
require_once __DIR__ . "/controller/indexNewsController.php";
?>


<head>
    <?php include(__DIR__ . "/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark <?php echo $SESSION_user_id == 0 ?'sidenav-toggled':'';?>" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>


<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->
        <div class="mb-0 mt-4">
            <i class="fa fa-newspaper-o"></i> ข่าวประชาสัมพันธ์
        </div>
        <hr class="mt-2">

        <div style="text-align: center;">
            <img src="<?php echo $img;?>" width="350">
            <div class="pt-3">
                <h3><?php echo $title;?></h3>

            </div>
        </div>
        <hr>
        <div class="pt-5" style="padding-left: 150px; width: 90%">
            <?php echo $detail;?>
            <hr>
            <small><?php echo $date;?></small>
        </div>

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->


</div>
</body>
<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>