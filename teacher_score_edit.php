<?php
require_once __DIR__.'/_session.php';
require_once __DIR__ . "/_loginTeacher.php";

$date = new DateTime();

$menuAction = 'grade';
$menuGrade = isset($_REQUEST['c']) ? $_REQUEST['c'] : 1;

$UrlYear = isset($_REQUEST['y']) ? $_REQUEST['y'] : $SCHOOL_YEAR;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");

$StudentId = isset($_REQUEST['sid']) ? $_REQUEST['sid'] : 1;

if ($menuGrade >= 10) {
    $className = "อนุบาล ".($menuGrade/10);
} else {
    $className = "ชั้นประถมศึกษาปีที่ " . $menuGrade;
}

$USERNAME = "";
$TEACHER = "";

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
            <h2> <i class="fa fa-calculator"></i> เกรด
                <small><a href="teacher_score.php?class=<?php echo $menuGrade;?>&year=<?php echo $UrlYear;?>"><?php echo $className; ?></a></small>
                ( <strong> <?php echo $USERNAME; ?> </strong> )  - ครูประจำชั้น <?php echo $TEACHER; ?>
            </h2>
        </div>
        <hr class="mt-2">

        <?php include(__DIR__.'/_alert.php');?>

        <div class="row justify-content-around">
            <div class="col-10">
                <form method="post">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="width: 25%">วิชา</th>
                            <th scope="col">คะแนนเก็บ</th>
                            <th scope="col">คะแนนกลางภาค</th>
                            <th scope="col">คะแนนปลายภาค</th>
                            <th scope="col">รวม</th>
                            <th scope="col">เกรด</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($GRADE as $key=>$item): ?>

                            <tr>
                                <th scope="row"><?php echo ($key+1);?></th>
                                <td> <?php echo $item['name'];?> (<small><?php echo $item['detail'];?> </small>) </td>
                                <td>
                                    <input type="text" name="score_exam<?php echo $key;?>" class="form-control" value="<?php echo $item['score_exam'];?>">
                                </td>
                                <td>
                                    <input type="text" name="center_exam<?php echo $key;?>" class="form-control" value="<?php echo $item['center_exam'];?>">
                                </td>
                                <td>
                                    <input type="text" name="final_exam<?php echo $key;?>" class="form-control" value="<?php echo $item['final_exam'];?>">
                                </td>
                                <td>
                                    <?php echo $item['sum_score'];?>
                                </td>
                                <td>
                                    <input type="text" name="courseId<?php echo $key;?>" value="<?php echo $item['id'];?>" hidden>
                                    <?php 
                                         if ($item['sum_score'] >= 80) $item['grade'] = '4';
                                          else if ($item['sum_score'] >= 75 and $item['sum_score'] < 80) $item['grade'] = '3.5';
                                          else if ($item['sum_score'] >= 70 and $item['sum_score'] < 75) $item['grade'] = '3';
                                          else if ($item['sum_score'] >= 65 and $item['sum_score'] < 70) $item['grade'] = '2.5';
                                          else if ($item['sum_score'] >= 60 and $item['sum_score'] < 65) $item['grade'] = '2';
                                          else if ($item['sum_score'] >= 55 and $item['sum_score'] < 60) $item['grade'] = '1.5';
                                          else if ($item['sum_score'] >= 50 and $item['sum_score'] < 55) $item['grade'] = '1';
                                          else $item['grade'] = '0';;
                                    ?>
                                    <input type="text" name="grade<?php echo $key;?>" class="form-control" value="<?php echo $item['grade'];?>">
 
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>

<!--                    --><?php //foreach ($GRADE as $key=>$item): ?>
<!---->
<!--                        <div class="form-group row">-->
<!--                            <label for="gradeInput--><?php //echo $key;?><!--" class="col-sm-4 col-form-label text-right">--><?php //echo $item['name'];?><!--</label>-->
<!--                            <div class="col-sm-2">-->
<!--                                <input type="text" name="courseId--><?php //echo $key;?><!--" value="--><?php //echo $item['id'];?><!--" hidden>-->
<!--                                <input type="text" name="grade--><?php //echo $key;?><!--" class="form-control" id="gradeInput--><?php //echo $key;?><!--" value="--><?php //echo $item['grade'];?><!--">-->
<!--                                <input type="text" name="grade--><?php //echo $key;?><!--" class="form-control" id="gradeInput--><?php //echo $key;?><!--" value="--><?php //echo $item['grade'];?><!--">-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                    --><?php //endforeach; ?>

                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-2 text-center">
                            <input type="text" name="fn" value="addUpdateGrade" hidden>
                            <input type="text" name="year" value="<?php echo $UrlYear;?>" hidden>
                            <input type="text" name="student_id" value="<?php echo $StudentId;?>" hidden>
                            <input type="text" name="countInput"value="<?php echo count($GRADE);?>" hidden>
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

