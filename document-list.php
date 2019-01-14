<?php
require_once __DIR__."/_session.php";
require_once __DIR__ . "/_loginTeacher.php";


$menuAction = 'document';
require_once __DIR__."/controller/documentListController.php";
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
            <h4><i class="fa fa-user"></i> เพิ่มเอกสารดาวโหลด </h4>
        </div>
        <hr class="mt-2">
        <div class="text-right mr-5">
            <a class="btn btn-success" role="button" href="document-edit.php"> <i class="fa fa-plus"></i> เพิ่มเอกสาร</a>
        </div>

        <div class="mb-0 mt-4">
            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                <thead style="font-size: 12px;">
                <tr>
                    <th>#</th>
                    <th>หัวข้อเอกสาร</th>
                    <th>หมวด</th>
                    <th>วันที่</th>
                    <ht>download</ht>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($DOCLIST as $key=>$item): ?>
                    <tr>
                        <td><?php echo ($key+1);?></td>
                        <td><?php echo $item['title'];?></td>
                        <td><?php echo $item['groups'];?></td>
                        <td><?php echo date("d-m-Y",strtotime($item['date_at']));?></td>
                        <td>
                            <?php
                            foreach ($item['files'] as $iFile){
                                echo '<a href="'.$iFile['path'].'" target="_blank">'.$iFile['name'].'</a><br>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="document-edit.php?docid=<?php echo $item['id'];?>">
                                <i class="fa fa-pencil"></i> edit
                            </a>
                            <button class="btn btn-link btn-sm text-danger"  onclick="setModalDelete('delete','<?php echo $item['title']; ?>','<?php echo $item['id']; ?>');">
                                <i class="fa fa-pencil"></i> delete
                            </button>
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

<?php include(__DIR__.'/_modalDeleteConfirm.php');?>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>