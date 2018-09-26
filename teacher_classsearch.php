<?php
require_once __DIR__."/_session.php";
require_once __DIR__ . "/_loginTeacher.php";

$menuAction = 'class';
$menuClass = 0;

require_once __DIR__."/controller/teacherClassSearchController.php";

?>


<head>
    <?php include(__DIR__ . "/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>

<div class="content-wrapper">

    <ul class="nav nav-pills breadcrumb">
        <li class="nav-item">
            <strong>ทะเบียน / ข้อมูล นักเรียน</strong>
        </li>
    </ul>

    <!-- search -->
    <div class="form-inline">
        <div class="form-group ml-5">
            <select class="btn btn-light" name="search_attr" id="search_attr">
                <option value="name">ชื่อ</option>
                <option value="surname">นามสกุล</option>
                <option value="id">User id</option>
                <option value="username">Username</option>
                <option value="id_card">เลขประจำตัวประชาชน</option>
            </select>
            <input class="form-control" name="search_value" id="search_value" type="text" value="">
            <button class="btn btn-info" type="submit" onclick="showSearch();" data-toggle="modal" data-target="#modalSearchListUser"><i class="fa fa-search"></i> Search</button>
        </div>
    </div>

    <hr>

    <div class="container-fluid" <?php echo  $searchUser?'':'hidden';?> >
        <!-- Card Columns Example Social Feed-->

        <ul class="nav nav-pills mb-3 mt-5" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">ข้อมูลนักเรียน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-grade-tab" data-toggle="pill" href="#pills-grade" role="tab" aria-controls="pills-grade" aria-selected="false">เกรด</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                <div class="text-center" style="padding-top: 20px;">
                    <img src="<?php echo $img_path; ?>" alt="File Upload" class="img-rounded"
                         style="height: 100px;">
                </div>
                <div class="pt-3" style="padding-left: 100px; width: 80%">

                    <div class="form-group">
                        <label>สถานะ :</label>
                        <input class="form-control" value="<?php echo $status; ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>ชื่อผู้ใช้งาน</label>
                        <input class="form-control" value="<?php echo $username; ?>" disabled>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label>ชื่อ</label>
                                <input class="form-control" value="<?php echo $name; ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label>นามสกุล</label>
                                <input class="form-control" value="<?php echo $surname; ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>รหัสบัตรประจำตัวประชาชน</label>
                        <input class="form-control" value="<?php echo $id_card; ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>วันเกิด</label>
                        <input class="form-control" type="date" value="<?php echo $birthday; ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>เบอร์โทร</label>
                        <input class="form-control" placeholder="เบอร์โทร" value="<?php echo $phone; ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>ที่อยู่</label>
                        <textarea class="form-control" placeholder="ที่อยู่" disabled><?php echo $address; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>เพศ</label>
                        <textarea class="form-control" placeholder="ที่อยู่" disabled><?php echo $gender == 'm'?'ชาย':'หญิง'; ?></textarea>
                    </div>

                    <hr>
                    <h5> ข้อมูลบิดา </h5>
                    <div class="form-group">
                        <label>ชื่อ-สกุล บิดา</label>
                        <input class="form-control" placeholder="ชื่อ-สกุล" value="<?php echo $name_father; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>ข้อมูลบิดา</label>
                        <textarea class="form-control" placeholder="ที่อยู่" disabled><?php echo $data_father; ?></textarea>
                    </div>

                    <hr>
                    <h5> ข้อมูลมารดา </h5>
                    <div class="form-group">
                        <label>ชื่อ-สกุล มารดา</label>
                        <input class="form-control" placeholder="ชื่อ-สกุล" value="<?php echo $name_mother; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>ข้อมูลมารดา</label>
                        <textarea class="form-control" placeholder="ที่อยู่" disabled><?php echo $data_mother; ?></textarea>
                    </div>

                    <hr>
                    <h5> ข้อมูลทั่วไป </h5>
                    <div class="date_admission form-group">
                        <label>วันที่เข้าเรียน</label>
                        <input class="form-control" type="date" value="<?php echo $date_admission; ?>" disabled>
                    </div>
                    <div class="report_grade form-group">
                        <label>รายงานผลการเรียนเดิม</label>
                        <textarea class="form-control" placeholder="รายงานผลการเรียนเดิม" disabled><?php echo $report_grade; ?></textarea>
                    </div>
                    <div class="date_issue form-group">
                        <label>วันที่จำหน่าย</label>
                        <input class="form-control" type="date" value="<?php echo $date_issue; ?>" disabled>
                    </div>
                    <div class="note_issue form-group">
                        <label>เหตุที่จำหน่าย</label>
                        <textarea class="form-control" placeholder="เหตุที่จำหน่าย" disabled><?php echo $note_issue; ?></textarea>
                    </div>
                    <div class="detail_report form-group">
                        <label>ความรู้และความประพฤติ</label>
                        <textarea class="form-control" placeholder="ความรู้และความประพฤติ" disabled><?php echo $detail_report; ?></textarea>
                    </div>
                    <div class="address_birth form-group">
                        <label>สถานที่เกิด</label>
                        <textarea class="form-control" placeholder="สถานที่เกิด" disabled><?php echo $address_birth; ?></textarea>
                    </div>
                    <div class="old_school form-group">
                        <label>สถานศึกษาเดิม</label>
                        <textarea class="form-control" placeholder="สถานศึกษาเดิม" disabled><?php echo $old_school; ?></textarea>
                    </div>
                    <div class="note_change_school form-group">
                        <label>เหตุที่ย้าย</label>
                        <textarea class="form-control" placeholder="เหตุที่ย้าย" disabled><?php echo $note_change_school; ?></textarea>
                    </div>
                    <div class="home_birth form-group">
                        <label>บ้านเกิด</label>
                        <textarea class="form-control" placeholder="บ้านเกิด" disabled><?php echo $home_birth; ?></textarea>
                    </div>
                </div>


            </div>
            <div class="tab-pane fade" id="pills-grade" role="tabpanel" aria-labelledby="pills-grade-tab">

                <?php foreach ($GRADE as $item): ?>

                    <table class="table table-bordered" style="width: 80%; margin: auto;">
                        <thead class="thead-light">
                        <tr class="table-info text-center" >
                            <td colspan="5" scope="col"><?=$item['class_str']?> ปีการศึกษา <?=$item['year_str'];?></td>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($item['grade'] as $k=>$item2): ?>
                            <tr>
                                <th scope="row"> <?=($k+1);?> </th>
                                <td><?=$item2['name']?></td>
                                <td><?=$item2['detail']?></td>
                                <td><?=$item2['final_exam']?></td>
                                <td><?=$item2['grade'];?></td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                    <hr>
                <?php endforeach; ?>

            </div>
        </div>




    </div>




</div>

</body>


<!--    modal -->
<div class="modal fade" id="modalSearchListUser" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รายวิชา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table id="table_usersearch" class="table table-striped table-bordered" style="width:100%;">
                    <thead style="font-size: 12px;">
                    <tr>
                        <th>เลขประจำตัวประชาชน</th>
                        <th>ชื่อ สกุล</th>
                        <th>Select</th>
                    </tr>
                    </thead>
                    <tbody id="showListSearch">

                    </tbody>
                </table>
            </div>

            <form class="modal-footer" method="post">
                <input id="modal_user_id" name="id" value=""  hidden>
                <button type="submit" class="btn btn-success" >เลือกสมาชิก</button>
            </form>

        </div>
    </div>
</div>


<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>

<script>


    function showSearch() {
        var attr = $('#search_attr').val();
        var value = $('#search_value').val();
        if(value.length > 0){
            var req = $.ajax({
                type: 'POST',
                url: './controller/service.php',
                data: {
                    fn: 'searchUser',
                    attr: attr,
                    value: value
                },
                dataType: 'JSON'
            });
            req.done(function (res) {
                if(res.status){
                    var item = res.data;
                    var str = "";
                    for(var i =0 ;i<item.length;i++){
                        if(i==0){
                            $('#modal_user_id').attr('value',item[i]['id']);
                        }
                        str+="<tr>";
                        str+="<td>"+item[i]['id_card']+"</td>";
                        str+="<td>"+item[i]['name']+" "+item[i]['surname']+"</td>";
                        str+="<td><input type='radio' name='modelSelectUser' value='"+item[i]['id']+"' "+((i==0)?"checked":"")+" onclick='clickSelect(this)' > Select</td>";
                        str+="</tr>";
                    }

                    $('#showListSearch').html(str);
                }
            });

        }

    }
    function clickSelect(res) {
        $('#modal_user_id').attr('value',$(res).val());
    }

</script>