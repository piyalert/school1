<?php
session_start();
require_once __DIR__."/controller/register.php";

$menuAction = 'user';

?>

<head>
<?php include( __DIR__."/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark pb-5" id="page-top">
  <!-- Navigation-->
  //<?php include( __DIR__."/memu.php"); ?>
    
  <div class="container">

      <?php if (isset($_SESSION['error'])){ ?>
      <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Warning!</strong>
          <p><?php echo $_SESSION['error'];?></p>
      </div>
      <?php unset($_SESSION['error']); } ?>


    <div class="card card-register mx-auto mt-1">
      <div class="card-header">เพิ่มสมาชิก</div>
      <div class="card-body">
        <form>

		  <div class="form-group">
            <label for="username">ชื่อผู้ใช้งาน</label>
            <input class="form-control" name="username" type="text" aria-describedby="nameHelp" placeholder="ชื่อผู้ใช้งาน" required>
          </div>

          <div class="form-group">
              <div class="form-row">
                  <div class="col-md-6">
                      <label for="exampleInputPassword1">รหัสผ่าน</label>
                      <input class="form-control" name="password" type="password" placeholder="รหัสผ่าน" required>
                  </div>
                  <div class="col-md-6">
                      <label for="exampleConfirmPassword">ยืนยันรหัสผ่าน</label>
                      <input class="form-control" name="confirmPassword" type="password" placeholder="ยืนยันรหัสผ่าน" required>
                  </div>
              </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">ชื่อ</label>
                <input class="form-control" id="name" type="text" aria-describedby="nameHelp" placeholder="ชื่อ" required>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">นามสกุล</label>
                <input class="form-control" id="lastname" type="text" aria-describedby="nameHelp" placeholder="นามสกุล" required>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputIdCard">รหัสบัตรประจำตัวประชาชน</label>
            <input class="form-control" name="id_card" type="text"  placeholder="รหัสบัตรประจำตัวประชาชน" required>
          </div>

            <div class="form-group">
                <label for="exampleInputBirthday">วันเกิด</label>
                <input class="form-control" name="birthday" type="date" required>
            </div>

            <div class="form-group">
                <label for="exampleInputPhone">เบอร์โทร</label>
                <input class="form-control" name="phone" type="text"  placeholder="เบอร์โทร">
            </div>

            <div class="form-group">
                <label for="exampleInputAddress">ที่อยู่</label>
                <textarea class="form-control" name="address" type="text" placeholder="ที่อยู่"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputGender">เพศ</label>
                <div>
                    <input type="radio" name="gander" id="gender1" value="m" checked> ชาย
                    <input type="radio" name="gander" id="gender2" value="f"> หญิง
                </div>
            </div>

<!--            <div class="form-group">-->
<!--                <label for="exampleInputEmail1">อีเมล์</label>-->
<!--                <input class="form-control" id="email" type="email" aria-describedby="emailHelp" placeholder="อีเมล์">-->
<!--            </div>-->
            <input class="text-hide" name="fn" value="insert">
          <button class="btn btn-primary btn-block mt-5" type="submit">Register</button>
        </form>
      </div>
    </div>
  </div>

</body>

<footer class="sticky-footer">
    <?php include( __DIR__."/footer.php"); ?>
</footer>