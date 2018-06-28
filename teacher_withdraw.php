<head>
<?php include( __DIR__."/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php include( __DIR__."/memu.php"); ?>
    
  <div class="content-wrapper">
        <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active"> <a href="teacher_deposit.php">ฝากเงิน</a></li>
        <li class="breadcrumb-item active"> <a href="teacher_withdraw.php">ถอนเงิน</a></li>
        <li class="breadcrumb-item active"> <a href="teacher_databalance.php">ดูข้อมูล</a></li>
      </ol>
	  
    <div class="container-fluid">
          <!-- Card Columns Example Social Feed-->
          <div class="mb-0 mt-4">
            <i class="fa fa-list-ol"></i>เลือกชั้นที่จะเช็คชื่อตามรหัสนักเรียน</div>
          <hr class="mt-2">

	   <!-- Example Social Card-->
     <div class="dropdown">
         <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">กรุณาเลือกรหัสที่่ต้องการ
        <span class="caret"></span></button>
       <ul class="dropdown-menu">
        <li><a href="#">54xxx</a></li>
        <li><a href="#">55xxx</a></li>
        <li><a href="#">56xxx</a></li>
        <li><a href="#">57xxx</a></li>
        </ul>
      </div>

    </div>

</body>

<footer class="sticky-footer">
<?php include( __DIR__."/footer.php"); ?>
</footer>