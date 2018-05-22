<head>
<?php include( __DIR__."/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  //<?php include( __DIR__."/memu.php"); ?>
    
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">สมัครสมาชิก</div>
      <div class="card-body">
        <form>
		  <div class="form-group">
            <label for="username">ชื่อผู้ใช้งาน</label>
            <input class="form-control" id="username" type="text" aria-describedby="nameHelp" placeholder="ชื่อผู้ใช้งาน">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">ชื่อ</label>
                <input class="form-control" id="name" type="text" aria-describedby="nameHelp" placeholder="ชื่อ">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">นามสกุล</label>
                <input class="form-control" id="lastname" type="text" aria-describedby="nameHelp" placeholder="นามสกุล">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">อีเมล์</label>
            <input class="form-control" id="email" type="email" aria-describedby="emailHelp" placeholder="อีเมล์">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">รหัสผ่าน</label>
                <input class="form-control" id="password" type="password" placeholder="รหัสผ่าน">
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">ยืนยันรหัสผ่าน</label>
                <input class="form-control" id="password1" type="password" placeholder="ยืนยันรหัสผ่าน">
              </div>
            </div>
          </div>
          <a class="btn btn-primary btn-block" href="login.php">Register</a>
        </form>
      </div>
    </div>
  </div>

</body>

<footer class="sticky-footer">
<?php include( __DIR__."/footer.php"); ?>
</footer>