<head>
<?php include( __DIR__."/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
    
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">เข้าสู่ระบบ</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">ชื่อผู้ใช้งาน</label>
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="ชื่อผู้ใช้งาน">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">รหัสผ่าน</label>
            <input class="form-control" id="exampleInputPassword1" type="password" placeholder="รหัสผ่าน">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox">จดจำรหัสผ่าน</label>
            </div>
          </div>
          <a class="btn btn-primary btn-block" href="index.php">เข้าสู่ระบบ</a>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
          <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

</body>