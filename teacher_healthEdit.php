<?php
require_once __DIR__."/_session.php";
require_once __DIR__ . "/_loginTeacher.php";

$menuAction = 'health';
$menuHealth = isset($_REQUEST['class']) ? $_REQUEST['class'] : '';

if($menuHealth>=10){
    $className = "อนุบาล ".($menuHealth/10);
}else{
    $className = "ประถมศึกษาปีที่ " . $menuHealth;
}


require_once __DIR__."/controller/teacherHealthEditController.php";

?>


<head>
    <?php include(__DIR__ . "/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>

<div class="content-wrapper">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <a href="teacher_health.php?class=<?php echo $menuHealth; ?>"><?php echo $className; ?> </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="teacher_healthlist.php?uid=<?php echo $user_id; ?>&class=<?php echo $menuHealth; ?>">
                <?php echo $USER_NAME; ?> <small>(<?php echo $USER_USERNAME; ?>)</small>
            </a>
        </li>
        <li class="breadcrumb-item active"> ตรวจสุขภาพ </li>
    </ol>

    <form class="container-fluid" method="post">
        <!-- Card Columns Example Social Feed-->

        <div class="mb-0 mt-4">

            <?php include(__DIR__.'/_alert.php'); ?>

            <div class="form-group">
                <label for="inputTitle">หัวข้อ</label>
                <input type="text" class="form-control" id="inputTitle" name="title" value="<?php echo $VISITING_TITLE; ?>" required>
            </div>

            <div class="form-group">
                <label for="inputDateAt">วันที่</label>
                <input type="date" class="form-control" id="inputDateAt" name="date_at" value="<?php echo $VISITING_DATE; ?>" required>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="inputHeight">ส่วนสูง</label>
                        <input class="form-control" id="inputHeight" name="height" type="text"
                               placeholder="ส่วนสูง" value="<?php echo $VISITING_HEIGHT; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputWeight">น้ำหนัก</label>
                        <input class="form-control" id="inputWeight" name="weight" type="text"
                               placeholder="น้ำหนัก" value="<?php echo $VISITING_WEIGHT; ?>" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputCongenitalDisease">โรคประจำตัว</label>
                <input type="text" class="form-control" id="inputCongenitalDisease" name="congenital_disease" value="<?php echo $VISITING_CONGENITAL_DISEASE; ?>">
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="inputDisabled">สมรรถภาพทางร่างกาย</label>
                        <select  class="form-control" id="inputDisabled" name="disabled" >
                            <option value="N">ปกติ</option>
                            <option value="Y" <?php echo $VISITING_DISABLED_NOTE=='Y'?'selected':''; ?> >พิการ</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputDisabledNote">พิการทางด้านใด</label>
                        <input class="form-control" id="inputDisabledNote" name="disabled_note" type="text"
                               placeholder="พิการทางด้านใด" value="<?php echo $VISITING_DISABLED_NOTE; ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputTooth">สุขภาพฟัน</label>
                <div id="inputTooth">
                    <input type="checkbox" name="fillings" value="Y" <?php echo $VISITING_FILLINGS=='Y'?'checked':''; ?> > <span class="pr-5"> อุดฟัน</span>
                    <input type="checkbox" name="scaling" value="Y" <?php echo $VISITING_SCALING=='Y'?'checked':''; ?> >  <span class="pr-5"> ขูดหินปูน</span>
                    <input type="checkbox" name="extraction" value="Y" <?php echo $VISITING_EXTRACTION=='Y'?'checked':''; ?> > ถอนฟัน
                </div>
            </div>

            <div class="form-group">
                <label for="inputDetail"> หมายเหตุ </label>
                <textarea id="inputDetail" class="form-control" name="detail"><?php echo $VISITING_DETAIL; ?></textarea>
            </div>


        </div>

        <div class="text-center" style="padding-top: 20px; padding-bottom: 30px;">
            <input id="about_id" name="about_id" value="<?php echo $VISITING_ID; ?>" hidden>
            <input name="fn" value="insertUpdate" hidden>
            <button type="submit" class="btn btn-success" >บันทึก</button>
            <button type="button" class="btn btn-danger" onclick="setModalDelete('deleteHealth','<?php echo $VISITING_TITLE; ?>','<?php echo $VISITING_ID; ?>');" >delete</button>
        </div>

    </form>


    <div class="value-attr" hidden>
        <input id="input_class" value="<?php echo $menuHealth;?>">
        <input id="input_user_id" value="<?php echo $user_id;?>">
    </div>


</div>


</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>

</footer>
<?php include(__DIR__.'/_modalDeleteConfirm.php');?>