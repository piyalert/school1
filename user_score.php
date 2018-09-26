<?php
require_once __DIR__.'/_session.php';
require_once __DIR__ . "/_loginStudent.php";

$date = new DateTime();

$menuAction = 'grade';
$user_id = $SESSION_user_id;

require_once __DIR__."/controller/userScoreController.php";
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
            <h2><i class="fa fa-calculator"></i> เกรด </h2></div>
        <hr class="mt-2">

        <?php foreach ($GRADE as $item): ?>

        <table class="table table-bordered" style="width: 80%; margin: auto;">
            <thead class="thead-light">
            <tr class="table-info text-center" >
                <td colspan="5" scope="col"><?=$item['class_str']?> ปีการศึกษา <?=$item['year_str'];?></td>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($item['grade'] as $k=>$item2): ?>
            <tr>
                <th scope="row"> <?=($k+1);?> </th>
                <td><?=$item2['name']?></td>
                <td><?=$item2['detail']?></td>
                <td><?=$item2['final_exam']?></td>
                <td><?=$item2['grade'];?></td>
            </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
        <hr>
        <?php endforeach; ?>

    </div>
</div>


</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>