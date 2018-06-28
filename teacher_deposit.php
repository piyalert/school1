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

<table border="0" cellspacing="0" cellpadding="3">

<tbody><tr><td width="10"></td>
<td colspan="2" class="pagename">รายชื่อสมาชิก</td></tr>
<tr class="headerdetail"><td><input type="HIDDEN" name="f_cmd" value="1"></td>
<td>โปรดระบุชื่อ<input type="TEXT" size="15" name="f_officername" value=""></td>
<td>นามสกุล<input type="TEXT" size="15" name="f_officersurname" value="">
<input type="SUBMIT" value="ค้นหา">

<input type="HIDDEN" name="backto" value="home"></td></tr>
<tr class="headerdetail"><td></td><td colspan="2">จำนวนรายการที่ได้จากการค้นหาไม่เกิน
<select name="f_maxrows"><option value="10" selected="">10</option>
<option value="30">30</option></select></td></tr></tbody></table>



    </div>

</body>

<footer class="sticky-footer">
<?php include( __DIR__."/footer.php"); ?>
</footer>