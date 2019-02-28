<?php
require_once __DIR__.'/_session.php';


$menuAction = 'health';

require_once __DIR__."/controller/userHealthViewController.php";
?>

<head>
    <?php include( __DIR__."/head.php"); ?>

</head>

<body class="fixed-nav sticky-footer bg-dark <?php echo $SESSION_user_id == 0 ?'sidenav-toggled':'';?>" id="page-top">
  <!-- Navigation-->
  <?php include( __DIR__."/memu.php"); ?>
  <div class="content-wrapper">
      <div class="container-fluid">
          <!-- Card Columns Example Social Feed-->
          <div class="mb-0 mt-4">
              <h2><i class="fa fa-user-circle"></i> ตรวจสุขภาพ </h2></div>
          <hr class="mt-2">

          <div class="mb-0 mt-4">
              <p>ห้วข้อ : <strong> <?php echo $VISITING_TITLE; ?></strong></p>
              <p>วันที่ : <strong> <?php echo formatDate($VISITING_DATE);?> </strong></p>
          </div>
          <hr>
          <div class="mb-0">
              <p>
                  <span>ส่วนสูง : <strong> <?php echo $VISITING_HEIGHT; ?></strong> </span>
                  <span class="ml-5"> น้ำหนัก : <strong> <?php echo $VISITING_WEIGHT; ?></strong></span>
              </p>

              <p>
                  <span> อุดฟัน : <strong> <?php echo $VISITING_FILLINGS=='Y'?'อุด':'ไม่อุด'; ?></strong> </span>
                  <span class="ml-5"> ขุดหินปูน : <strong> <?php echo $VISITING_SCALING=='Y'?'ขูด':'ไม่ขูด'; ?></strong> </span>
                  <span class="ml-5"> ถอนฟัน : <strong> <?php echo $VISITING_EXTRACTION=='Y'?'ถอน':'ไม่ถอน'; ?></strong> </span>
              </p>
              <p>
                  <span> โรคประจำตัว : <strong> <?php echo $VISITING_CONGENITAL_DISEASE; ?></strong> </span>
              </p>

              <p>
                  <span>สมรรถภาพทางร่างกาย : <strong> <?php echo $VISITING_DISABLED=='Y'?'พิการ':'ปกติ'; ?> </strong> </span>
                  <span class="ml-5"> พิการทางด้านใด : <strong> <?php echo $VISITING_DISABLED_NOTE; ?></strong></span>
              </p>

              <p>
                  <span> หมายเหตุ : <strong> <?php echo $VISITING_DETAIL; ?></strong> </span>
              </p>

          </div>
      </div>
  </div>


</body>

<footer class="sticky-footer">
<?php include( __DIR__."/footer.php"); ?>
</footer>
