<?php
require_once __DIR__."/_session.php";
require_once __DIR__ . "/_loginStudent.php";

$menuAction = 'portfolio';

require_once __DIR__."/controller/userPortfolioListController.php";

?>


<head>
    <?php include(__DIR__ . "/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>

<div class="content-wrapper">
    <!-- Breadcrumbs-->
    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->
        <table id="table_student" class="table table-striped table-bordered" style="width:100%;">

            <div class="mb-0 mt-4">
                <h2><i class="fa fa-address-card"></i> กิจกรรมและผลงาน </h2></div>
            <hr class="mt-2">

            <thead style="font-size: 12px;">
            <tr>
                <th>#</th>
                <th>วันที่</th>
                <th>หัวเรื่อง</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($PORTFOLIOS as $key=>$item): ?>
                <tr>
                    <td><?php echo ($key+1);?></td>
                    <td><?php echo date('d/m/Y',strtotime($item['date_at']));?></td>
                    <td><?php echo $item['title'];?></td>
                    <td>
                        <a href="user_portfolioview.php?id=<?php echo $item['id'];?>"><i class="fa fa-eye"></i> รายละเอียด</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</div>


</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>

<script>
    $(document).ready(function() {
        $('#table_student').DataTable();
    } );

</script>