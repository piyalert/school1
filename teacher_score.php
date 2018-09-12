<?php
require_once __DIR__.'/_session.php';
$date = new DateTime();

$menuAction = 'grade';
$menuGrade = isset($_REQUEST['class']) ? $_REQUEST['class'] : 1;

$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : $SCHOOL_YEAR;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;

if ($menuGrade == 10) {
    $className = "อนุบาล 1";
} elseif ($menuGrade == 20) {
    $className = "อนุบาล 2";
} else {
    $className = "ชั้นประถมศึกษาปีที่ " . $menuGrade;
}

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

        <div class="form-inline">
            <div class="form-group ml-5">
                <label class="mr-3" for="input_year" > ปีการศึกษา </label>
                <select class="form-control" id="input_year" name="year" onchange="">
                    <?php for ($i=$year;$i>($year-10);$i--): ?>
                        <option value="<?php echo ($i);?>"  <?php echo $UrlYear==$i?'selected':'' ?>> <?php echo ($i+543); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>


    </div>
</div>


</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>
