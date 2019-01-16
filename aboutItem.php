<?php
require_once __DIR__.'/_session.php';

$menuAction = 'about';
$menuAbout = 'itemshow';

require_once __DIR__."/controller/aboutController.php";
?>

<head>
    <?php include( __DIR__."/head.php"); ?>

    <!-- css froala -->
    <?php include( __DIR__."/_froalaCss.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark <?php echo $SESSION_user_id == 0 ?'sidenav-toggled':'';?>" id="page-top">
<!-- Navigation-->
<?php include( __DIR__."/memu.php"); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->
        <div class="mb-0 mt-4">
            <h4><i class="fa fa-building-o"></i> ครุภัณฑ์ </h4>
        </div>
        <hr class="mt-2">

        <div class="mb-0 mt-4 p-5 fr-view">
            <?php echo $detail; ?>
        </div>
    </div>
</div>


</body>

<footer class="sticky-footer">
    <?php include( __DIR__."/footer.php"); ?>
</footer>
