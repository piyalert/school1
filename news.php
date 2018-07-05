<?php
require_once __DIR__."/_session.php";



$menuAction = 'news';
require_once __DIR__."/controller/newsController.php";
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
            <h4><i class="fa fa-user"></i> เพิ่มข่าวประกาศ </h4>
        </div>
        <hr class="mt-2">
        <div class="text-right mr-5">
            <a class="btn btn-success" role="button" href="news_add.php"> <i class="fa fa-plus"></i> เพิ่มข่าว</a>
        </div>

        <div class="mb-0 mt-4">
            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                <thead style="font-size: 12px;">
                <tr>
                    <th>ภาพ</th>
                    <th>หัวข้อ</th>
                    <th>ปีการศึกษา</th>
                    <th>วันที่เพิ่มข่าว</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($NEWSLIST as $item): ?>
                    <tr>
                        <td class="text-center"><img src="<?php echo $item['img'];?>" style="width: 100px;"></td>
                        <td><?php echo $item['title'];?></td>
                        <td><?php echo $item['year']+543;?></td>
                        <td><?php echo $item['create_at'];?></td>
                        <td>
                            <a href="news_edit.php?id=<?php echo $item['id'];?>">
                                <i class="fa fa-pencil"></i> edit
                            </a>
                            <a href="news.php?fn=delete&id=<?php echo $item['id'];?>" style="padding-left: 20px; color: red;">
                                <i class="fa fa-pencil"></i> delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
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