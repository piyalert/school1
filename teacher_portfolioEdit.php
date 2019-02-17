<?php
require_once __DIR__."/_session.php";
require_once __DIR__ . "/_loginTeacher.php";

$menuAction = 'portfolio';
$menuPortfolio = isset($_REQUEST['class']) ? $_REQUEST['class'] : '';

if($menuPortfolio>=10){
    $className = "อนุบาล ".($menuPortfolio/10);
}else{
    $className = "ประถมศึกษาปีที่ " . $menuPortfolio;
}


require_once __DIR__."/controller/teacherPortfolioEditController.php";

?>


<head>
    <?php include(__DIR__ . "/head.php"); ?>
    <!-- css froala -->
    <?php include( __DIR__."/_froalaCss.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>

<div class="content-wrapper">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <a href="teacher_portfolio.php?class=<?php echo $menuPortfolio; ?>"><?php echo $className; ?> </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="teacher_portfoliolist.php?uid=<?php echo $user_id; ?>&class=<?php echo $menuPortfolio; ?>">
                <?php echo $USER_NAME; ?> <small>(<?php echo $USER_USERNAME; ?>)</small>
            </a>
        </li>
        <li class="breadcrumb-item active"> กิจกรรมและผลงาน </li>
    </ol>

    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->

        <div class="mb-0 mt-4">

            <div class="form-group">
                <label for="inputTitle">หัวข้อ</label>
                <input type="text" class="form-control" id="inputTitle" value="<?php echo $PORTFOLIO_TITLE; ?>">
            </div>

            <div class="form-group">
                <label for="inputDateAt">วันที่</label>
                <input type="date" class="form-control" id="inputDateAt" value="<?php echo $PORTFOLIO_DATE; ?>">
            </div>


            <div class="form-group">
                <label for="username">รายละเอียด </label>
                <div id="editor">
                    <div id='edit'> <?php echo $PORTFOLIO_DETAIL; ?> </div>
                </div>
            </div>

        </div>

        <div class="text-center" style="padding-top: 20px; padding-bottom: 30px;">
            <input id="about_id" name="about_id" value="<?php echo $PORTFOLIO_ID; ?>" hidden>
            <button type="button" class="btn btn-success" onclick="saveAbout();" >บันทึก</button>
        </div>

    </div>


    <div class="value-attr" hidden>
        <input id="input_class" value="<?php echo $menuPortfolio;?>">
        <input id="input_user_id" value="<?php echo $user_id;?>">
    </div>


</div>


</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>

    <!-- froala script -->
    <?php include( __DIR__."/_froalaScript.php"); ?>

</footer>

<script>
    $(function() {
        $('#edit').froalaEditor({
            heightMin: 250,
        });
    });

    function saveAbout() {
        var detail = $('#edit').froalaEditor("html.get");
        var id = $('#about_id').val();
        var user_id = $('#input_user_id').val();
        var date = $('#inputDateAt').val();
        var title = $('#inputTitle').val();
        var classroom = $('#input_class').val();
        if(id==0){
            var req = $.ajax({
                type: 'POST',
                url: './controller/service.php',
                data: {
                    fn: 'insertPortfolio',
                    user_id:user_id,
                    title: title,
                    date_at: date,
                    detail: detail,
                },
                dataType: 'JSON'
            });
        }else{
            var req = $.ajax({
                type: 'POST',
                url: './controller/service.php',
                data: {
                    fn: 'updatePortfolio',
                    user_id:user_id,
                    title: title,
                    date_at: date,
                    detail: detail,
                    id: id
                },
                dataType: 'JSON'
            });
        }

        req.done(function (res) {
            if(res.status){
                alert('save data complete...');
                document.location = "teacher_portfoliolist.php?uid="+user_id+"&class="+classroom;
            }else{
                alert('save data false!!!!');
            }
        });


    }


</script>