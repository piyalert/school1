<?php
require_once __DIR__ . "/_session.php";

$menuAction = 'home';
require_once __DIR__ . "/controller/indexController.php";
?>


<head>
    <?php include(__DIR__ . "/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark <?php echo $SESSION_user_id == 0 ?'sidenav-toggled':'';?>" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>


<div class="content-wrapper">
    <div class="container-fluid alert-danger">
        <!-- Card Columns Example Social Feed-->

        <div style="height: 150px; border: solid 1px;" class="">
            <img src="./pictures/banner.jpg" style="height: 150px; width: 100%;">
        </div>

        <div class="row">
            <div class="col-9">
                <div class="mb-0 mt-4">
                    <i class="fa fa-newspaper-o"></i> ข่าวประชาสัมพันธ์
                </div>
                <hr class="mt-2">
                <div class="card-columns">

                    <?php foreach ($NEWSLIST as $key => $item): ?>

                        <div class="card mb-3 <?php echo $key==0?'col-12':'';?>">
                            <a href="index_news.php?id=<?php echo $item['id'] ?>">
                                <img class="card-img-top img-fluid w-100" src="<?php echo $item['img'];?>" alt="<?php echo $item['title'];?>">
                            </a>
                            <div class="card-body">
                                <h6 class="card-title mb-1"> <a href="index_news.php?id=<?php echo $item['id'] ?>"> <?php echo $item['title'];?> </a></h6>
                                <p class="card-text small"><?php echo $item['create_at'];?></p>
                            </div>
                            <hr class="my-0">
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
            <div class="col-3 text-right">
                <div style="height: 150px;">
                 <img src="./pictures/rig.jpg" width="250" height="800" alt="">
                </div>
            </div>
        </div>



    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->


</div>
</body>
<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>