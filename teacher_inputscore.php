<head>
<?php include( __DIR__."/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php include( __DIR__."/memu.php"); ?>
    
  <div class="content-wrapper">
        <!-- Breadcrumbs-->
      <ol class="breadcrumb">
      <li class="breadcrumb-item active"> <a href="managestudent.php">จัดการผู้เรียน</a></li>
        <li class="breadcrumb-item active"> <a href="teacher_checkname.php">เช็คชื่อเข้าเรียน</a></li>
        <li class="breadcrumb-item active"> <a href="teacher_inputscore.php">กรอกคะแนน</a></li>
        <li class="breadcrumb-item active"> <a href="teacher_name.php">ข้อมูลการเข้าเรียน</a></li>
        <li class="breadcrumb-item active"> <a href="teacher_score.php">ผลการเรียน</a></li>
        
      </ol>
	  
    <div class="container-fluid">
          <!-- Card Columns Example Social Feed-->
          <div class="mb-0 mt-4">
           <h2> <i class="fa fa-play-circle-o"></i>กรอกผลการเรียน <h2></div>
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

            <br></br>

<table id="example" class="table table-striped table-bordered" style="width:100%;font-size: 12px;">
            <thead style="font-size: 12px;">
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>คะแนนเก็บ</th>
                <th>คะแนนสอบ</th>
                <th>คะแนนกลาง</th>
                <th>อื่นๆ</th>
            </tr>
            </thead>
            <tbody>
              <?//php foreach ($USERS as $item): ?>
                  <tr>
                      <td>1</td>
                      <td>xxxxxxxxx</td>
                      <td>yyyyyyyy</td>
                      <td> <input type="text" name="keep"</td>
                      <td> <input type="text" name="test"</td>
                      <td> <input type="text" name="center"</td>
                      <td> <input type="text" name="other"</td>
<!--                            <td><?//php echo $item['address'];?></td>    -->
                    <tr>
            </tbody>
            

<!--                  <tfoot>-->
<!--                  <tr style="font-size: 10px;">-->
<!--                      <th>Username</th>-->
<!--                      <th>ID.Card</th>-->
<!--                      <th>Name Surname</th>-->
<!--                      <th>Gender</th>-->
<!--                      <th>Birthday</th>-->
<!--                      <th>Phone</th>-->
<!--                      <th>Address</th>-->
<!--                      <th>Action</th>-->
<!--                  </tr>-->
<!--                  </tfoot>-->
        </table>
      <center>  <input type="submit" value="Clear">
        <input type="submit" value="Submit">    </center>

    </div>

</body>

<footer class="sticky-footer">
<?php include( __DIR__."/footer.php"); ?>
</footer>