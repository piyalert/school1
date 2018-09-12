<?php
require_once __DIR__.'/_session.php';
$date = new DateTime();

$menuAction = 'grade';
$menuGrade = isset($_REQUEST['c']) ? $_REQUEST['c'] : 1;

$UrlYear = isset($_REQUEST['y']) ? $_REQUEST['y'] : $SCHOOL_YEAR;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");

$user_id = isset($_REQUEST['uid']) ? $_REQUEST['uid'] : 1;

if ($menuGrade == 10) {
    $className = "อนุบาล 1";
} elseif ($menuGrade == 20) {
    $className = "อนุบาล 2";
} else {
    $className = "ชั้นประถมศึกษาปีที่ " . $menuGrade;
}


//require_once __DIR__."/controller/teacherScoreController.php";

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



    </div>
</div>


</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>
