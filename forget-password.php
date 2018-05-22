<head>
<?php include( __DIR__."/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  //<?php include( __DIR__."/memu.php"); ?>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">รีเซ็ตรหัสผ่าน</div>
      <div class="card-body">
        <div class="text-center mt-4 mb-5">
          <h4>คุณลืมรหัสผ่าน?</h4>
          <p>กรุณากรอกอีเมล์ที่สามารถใช้งานได้</p>
        </div>
        <form>
          <div class="form-group">
            <input class="form-control" id="InputEmail1" type="email" aria-describedby="emailHelp" placeholder="กรุณากรอกอีเมล์">
          </div>
          <a class="btn btn-primary btn-block" href="login.php">รีเซ็ตรหัสผ่าน</a>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">สมัครสมาชิก</a>
        </div>
      </div>
    </div>
  </div>

</body>

<footer class="sticky-footer">
<?php include( __DIR__."/footer.php"); ?>
</footer>