<?php
require_once __DIR__ . "/_session.php";

require_once __DIR__."/controller/loginController.php";
?>

<head>
    <?php include(__DIR__ . "/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark pb-5 <?php echo $SESSION_user_id == 0 ?'sidenav-toggled':'';?>" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>

<div class="container">

    <div class="card card-register mx-auto mt-1">
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <strong>Warning!</strong>
                <p><?php echo $_SESSION['error']; ?></p>
            </div>
            <?php unset($_SESSION['error']);
        } ?>
        <div class="card-header text-center"><h3> เข้าสู่ระบบ </h3></div>
        <div class="card-body">
            <form method="post">

                <div class="form-group">
                    <label for="username">ชื่อผู้ใช้งาน</label>
                    <input class="form-control" name="username" type="text" aria-describedby="nameHelp"
                           placeholder="ชื่อผู้ใช้งาน" value="" required>
                </div>

                <div class="form-group">
                    <label for="password">รหัสผ่าน</label>
                    <input class="form-control" name="password" type="password" placeholder="รหัสผ่าน" value=""
                           required>
                </div>

                <input name="fn" value="login" hidden>
                <button class="btn btn-primary btn-block mt-5" type="submit">Log In</button>

            </form>
        </div>
    </div>
</div>

</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>
