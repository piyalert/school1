<?php
session_start();
require_once __DIR__."/controller/register.php";

$menuAction = 'user';
$menuSub = 'register';

?>

<head>
<?php include( __DIR__."/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark pb-5" id="page-top">
  <!-- Navigation-->
  <?php include( __DIR__."/memu.php"); ?>
    
  <div class="container">

    <div class="card card-register mx-auto mt-1">
            <?php if (isset($_SESSION['error'])){ ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Warning!</strong>
                <p><?php echo $_SESSION['error'];?></p>
            </div>
            <?php unset($_SESSION['error']); } ?>

      <div class="card-header"><?php if($passwordCheck)echo'เพิ่มสมาชิก';else echo'แก้ไขสมาชิก'; ?></div>
      <div class="card-body">
        <form action="/school/register.php" method="post">

		  <div class="form-group">
            <label for="username">ชื่อผู้ใช้งาน</label>
            <input class="form-control" name="username" type="text" aria-describedby="nameHelp" placeholder="ชื่อผู้ใช้งาน" value="<?php echo $username;?>" required>
          </div>

          <div class="form-group" <?php if(!$passwordCheck)echo 'style="display: none"';?> >
              <div class="form-row">
                  <div class="col-md-6">
                      <label for="exampleInputPassword1">รหัสผ่าน</label>
                      <input class="form-control" name="password" type="password" id="password" placeholder="รหัสผ่าน" <?php if($passwordCheck)echo 'required';?> >
                  </div>
                  <div class="col-md-6">
                      <label for="exampleConfirmPassword">ยืนยันรหัสผ่าน</label>
                      <input class="form-control" name="confirmPassword" type="password" id="confirmPassword" placeholder="ยืนยันรหัสผ่าน" <?php if($passwordCheck)echo 'required';?> >
                  </div>
              </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">ชื่อ</label>
                <input class="form-control" name="name" type="text" aria-describedby="nameHelp" placeholder="ชื่อ" value="<?php echo $name;?>" required>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">นามสกุล</label>
                <input class="form-control" name="surname" type="text" aria-describedby="nameHelp" placeholder="นามสกุล" value="<?php echo $surname;?>" required>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputIdCard">รหัสบัตรประจำตัวประชาชน</label>
            <input class="form-control" name="id_card" type="text"  placeholder="รหัสบัตรประจำตัวประชาชน" value="<?php echo $id_card;?>" required>
          </div>

            <div class="form-group">
                <label for="exampleInputBirthday">วันเกิด</label>
                <input class="form-control" name="birthday" type="date" value="<?php echo $birthday;?>" required>
            </div>

            <div class="form-group">
                <label for="exampleInputPhone">เบอร์โทร</label>
                <input class="form-control" name="phone" type="text" placeholder="เบอร์โทร" value="<?php echo $phone;?>">
            </div>

            <div class="form-group">
                <label for="exampleInputAddress">ที่อยู่</label>
                <textarea class="form-control" name="address" type="text" placeholder="ที่อยู่"><?php echo $address;?></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputGender">เพศ</label><br>
                <input type="radio" name="gender" value="m" <?php if($gender==='m')echo'checked';?> > ชาย
                <input type="radio" name="gender" value="f" <?php if($gender==='f')echo'checked';?> > หญิง
            </div>

            <?php if($passwordCheck): ?>
                <input name="fn" value="insert" hidden>
                <button class="btn btn-primary btn-block mt-5" type="submit">Register</button>
            <?php else: ?>

                <input name="fn" value="update" hidden>
                <input name="id" value="<?php echo $id;?>" hidden>
                <button class="btn btn-primary btn-block mt-5" type="submit">Edit</button>
            <?php endif; ?>
        </form>
      </div>
    </div>
  </div>

</body>

<footer class="sticky-footer">
    <?php include( __DIR__."/footer.php"); ?>
    <script>
        $( "#password" ).change(function() {
            $("#confirmPassword").val('');
        });
        $( "#confirmPassword" ).change(function() {
            var password = $("#password").val();
            var confirm = $("#confirmPassword").val();
            if(confirm!=password){
                alert( "Confirm password Error!!" );
                $("#password").val('');
                $("#confirmPassword").val('');
            }

        });
    </script>

</footer>
