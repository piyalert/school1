<?php
require_once __DIR__."/controller/userManage.php";

$menuAction = 'user';
$USERS = [];



?>

<head>
<?php include( __DIR__."/head.php"); ?>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php include( __DIR__."/memu.php"); ?>
	
  
  <div class="content-wrapper">
    <div class="container-fluid">
          <!-- Card Columns Example Social Feed-->
          <div class="mb-0 mt-4">
            <i class="fa fa-user"></i> ข้อมูลสมาชิก</div>
          <hr class="mt-2">

          <div class="">

              <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                  <tr>
                      <th>Username</th>
                      <th>ID.Card</th>
                      <th>Name Surname</th>
                      <th>Gender</th>
                      <th>Birthday</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($USERS as $item): ?>
                        <tr>
                            <td><?php echo $item['id'];?></td>
                            <td><?php echo $item['id'];?></td>
                            <td><?php echo $item['id'];?></td>
                            <td><?php echo $item['id'];?></td>
                            <td><?php echo $item['id'];?></td>
                            <td><?php echo $item['id'];?></td>
                            <td><?php echo $item['id'];?></td>
                            <td><?php echo $item['id'];?></td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                      <th>Username</th>
                      <th>ID.Card</th>
                      <th>Name Surname</th>
                      <th>Gender</th>
                      <th>Birthday</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Action</th>
                  </tr>
                  </tfoot>
              </table>

          </div>

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->



  </div>
</body>
<footer class="sticky-footer">
<?php include( __DIR__."/footer.php"); ?>
</footer>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>