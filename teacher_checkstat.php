<?php

require_once __DIR__ . "/_session.php";
require_once __DIR__ . "/_loginTeacher.php";
$date = new DateTime();

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 8/10/2018
 * Time: 4:05 PM
 */

$menuAction = 'check';

$student_id = isset($_REQUEST['uid']) ? $_REQUEST['uid'] : '1';

//parameter
$studentName = '';
$studentId  = '';
$studentClass = '';
$CHECKS = [];
$sc = 0;
$scp = 0;
$sl = 0;
$slp = 0;
$sm = 0;
$smp = 0;
$ss = 0;
$ssp = 0;

//end parameter
require_once __DIR__."/controller/teacherCheckStatController.php";
?>

<head>
    <?php include(__DIR__ . "/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>

<div class="content-wrapper">

    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->
        <div class="mb-0 mt-4">
            <h2><i class="fa fa-check-square"></i> เช็คชื่อเข้าเรียน  </h2>
        </div>
        <hr class="mt-2">

        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-4">
                    <div class="border p-2">
                        <p>รหัสประจำตัวนักเรียน : <span class="ml-2 font-weight-bold text-primary"> <?php echo $studentId; ?></span></p>
                        <p>ชื่อ-สกุล : <span class="ml-2 font-weight-bold text-primary"> <?php echo $studentName; ?></span></p>
                        <p>ห้องเรียน : <span class="ml-2 font-weight-bold text-primary"> <?php echo $studentClass; ?></span></p>

                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                            <tr class="table-danger">
                                <td>สถานะการมาเรียน</td>
                                <td>จำนวน (ครั้ง) </td>
                                <td> ร้อยละ </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-right">มา</td>
                                <td> <?php echo $sc; ?></td>
                                <td> <?php echo number_format($scp,2,'.',',');?> </td>
                            </tr>
                            <tr>
                                <td class="text-right">ลา</td>
                                <td> <?php echo $sl; ?></td>
                                <td> <?php echo number_format($slp,2,'.',',');?> </td>
                            </tr>
                            <tr>
                                <td class="text-right">ขาด</td>
                                <td> <?php echo $sm;?></td>
                                <td> <?php echo number_format($smp,2,'.',',');?> </td>
                            </tr>
                            <tr class="table-danger">
                                <td class="text-right">รวม</td>
                                <td> <?php echo $ss; ?></td>
                                <td> <?php echo number_format($ssp,2,'.',',');?> </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="col-8">
                    <table class="table table-bordered table-hover table-sm" id="table_check">
                        <thead>
                        <tr class="table-danger">
                            <td>ลำดับ</td>
                            <td>วันที่</td>
                            <td>สถานะ</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($CHECKS as $key=>$item):?>
                        <tr>
                            <td> <?php echo ($key+1); ?> </td>
                            <td> <?php echo $item['date_thai'];?> </td>
                            <td> <?php echo $item['check_str'];?> </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>


    </div>
</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>

    <script>

        $(document).ready(function () {
            $('#table_check').DataTable({
                // "lengthChange": false,
                "bInfo": false,
                // "iDisplayLength": 100,
                // "paging": false
            });
        });

    </script>
</footer>

