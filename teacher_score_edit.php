<?php
require_once __DIR__.'/_session.php';
$date = new DateTime();

$menuAction = 'grade';
$menuGrade = isset($_REQUEST['c']) ? $_REQUEST['c'] : 1;

$UrlYear = isset($_REQUEST['y']) ? $_REQUEST['y'] : $SCHOOL_YEAR;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");

$StudentId = isset($_REQUEST['sid']) ? $_REQUEST['sid'] : 1;

if ($menuGrade == 10) {
    $className = "อนุบาล 1";
} elseif ($menuGrade == 20) {
    $className = "อนุบาล 2";
} else {
    $className = "ชั้นประถมศึกษาปีที่ " . $menuGrade;
}

$USERNAME = "";

require_once __DIR__."/controller/teacherScoreEditController.php";

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
            <h2><i class="fa fa-calculator"></i> เกรด <small> <?php echo $className; ?> </small> ( <strong> <?php echo $USERNAME;?> </strong> ) </h2></div>
        <hr class="mt-2">

        <div class="row justify-content-around">
            <div class="col-10">
                <form method="post">

                    <?php foreach ($GRADE as $key=>$item): ?>

                        <div class="form-group row">
                            <label for="subject<?php echo $key;?>" class="col-sm-4 col-form-label text-right"><?php echo $item['name'];?></label>
                            <div class="col-sm-2">
                                <input type="text" name="subjectid<?php echo $key;?>" value="<?php echo $item['subject_id'];?>" hidden>
                                <input type="text" class="form-control" id="subject<?php echo $key;?>" value="<?php echo $item['grade'];?>">
                            </div>
                        </div>

                    <?php endforeach; ?>

                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-2 text-center">
                            <input type="text" name="fn" value="addUpdateGrade" hidden>
                            <input type="text" name="year" value="<?php echo $UrlYear;?>" hidden>
                            <input type="text" name="student_id" value="<?php echo $StudentId;?>" hidden>

                            <button class="btn btn-success" type="submit"> บันทึก </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>





    </div>
</div>


</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>
