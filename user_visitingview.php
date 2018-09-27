<?php
require_once __DIR__.'/_session.php';


$menuAction = 'visiting';

require_once __DIR__."/controller/userVisitingViewController.php";
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
              <h2><i class="fa fa-home"></i> เยี้ยมบ้าน </h2></div>
          <hr class="mt-2">

          <div class="mb-0 mt-4 p-3">
              <p>ห้วข้อ : <strong> <?php echo $VISITING_TITLE; ?></strong></p>
              <p>วันที่ : <strong> <?php echo $VISITING_DATE;?> </strong></p>
          </div>
          <hr>
          <div class="mb-0 p-2 fr-view bg-light">
              <?php echo $VISITING_DETAIL; ?>
          </div>
      </div>
  </div>


</body>

<footer class="sticky-footer">
<?php include( __DIR__."/footer.php"); ?>
</footer>
