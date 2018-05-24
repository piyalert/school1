<?php
require_once __DIR__."/controller/register.php";

$menuAction = 'user';

?>

<head>
<?php include( __DIR__."/head.php"); ?>

    <link href="plugins/dataTable/jquery.bootgrid.css" rel="stylesheet">


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

              <table id="grid-data" class="table table-condensed table-hover table-striped">
                  <thead>
                  <tr>
                      <th data-column-id="id" data-type="numeric">ID</th>
                      <th data-column-id="sender">Sender</th>
                      <th data-column-id="received" data-order="desc">Received</th>
                      <th data-column-id="link" data-formatter="link" data-sortable="false">Link</th>
                  </tr>
                  </thead>
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