<?php
require_once __DIR__ . "/_session.php";

$menuAction = 'user';
$menuSub = 'register';

$disabled = '';
if ($SESSION_user_status != 'teacher') $disabled='disabled';


require_once __DIR__ . "/controller/register.php";
?>

<head>
    <?php include(__DIR__ . "/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark pb-5" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>

<div class="content-wrapper">

    <div class="card card-index mx-auto mt-1">
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <strong>Warning!</strong>
                <p><?php echo $_SESSION['error']; ?></p>
            </div>
            <?php unset($_SESSION['error']);
        } ?>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <strong>Success.</strong>
                <p><?php echo $_SESSION['success']; ?></p>
            </div>
            <?php unset($_SESSION['success']);
        } ?>


        <div class="card-header"><?php if ($passwordCheck) echo 'เพิ่มสมาชิก'; else echo 'แก้ไขสมาชิก'; ?></div>
        <div class="card-body">

            <div id="loadFile" class="text-center">
                <div class="form-show-file" style="padding-top: 20px;">
                    <img id="src_image" src="<?php echo $img_path; ?>" alt="File Upload" class="img-rounded"
                         style="height: 100px;">
                </div>
                <div class="form-inline" id="show_progressBar_upload" hidden>
                    <div class="progress" style="float:left; width: 90%; margin-right: 5px;">
                        <div id="progressBar_upload" class="progress-bar" role="progressbar"
                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                             style="width: 0%;">
                            0%
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-xs"
                            onclick="cancelUploadFile()">
                        <span class="fa fa-remove" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="text-center" style="padding-top: 20px;">
                    <div class="box-img-ready">
                        <label class="alert alert-dark" style="cursor: pointer" for="file_upload">
                            <span class="label label-info"><i class="fa fa-upload"></i> Upload </span>
                            <input id="file_upload" accept="image/*" type="file" style="display:none;"
                                   onchange="uploadFile(this)">
                        </label>
                    </div>
                </div>

            </div>

            <div class="text-right mb-1" <?php echo ($passwordCheck)?'hidden':''; ?>>
                <button class="btn btn-warning btn-sm" onclick="changePassword();">Change Password</button>
            </div>
            <form id="changePassword" class="bg-warning p-2" method="post" hidden >
                <div class="text-center">
                    <h4>Change Password</h4>
                </div>
                <div class="form-group">
                    <label for="EPassword">รหัสผ่านเดิม<strong class="text-danger">**</strong></label>
                    <input class="form-control" name="EOPassword" type="password" aria-describedby="nameHelp"
                           placeholder="รหัสผ่านเดิม" value="" required>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">รหัสผ่าน <strong class="text-danger">**</strong></label>
                            <input class="form-control password" name="Epassword" type="password" placeholder="รหัสผ่าน" required>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleConfirmPassword">ยืนยันรหัสผ่าน <strong class="text-danger">**</strong></label>
                            <input class="form-control confirmPassword" name="EconfirmPassword" type="password" placeholder="ยืนยันรหัสผ่าน" required>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <input name="Efn" value="changePassword" hidden>
                    <button class="btn btn-info" type="submit">Edit</button>
                    <button class="btn btn-danger" type="button" onclick="changePasswordClose();">Close</button>
                </div>

                <hr>
            </form>



            <form action="/school/register.php" method="post">

                <div class="form-group">
                    <label for="exampleInputStatus">สถานะ <strong class="text-danger">**</strong></label><br>
                    <input type="radio" name="status" value="teacher" <?php if ($status == 'teacher') echo 'checked'; ?> <?php echo $disabled;?> > อาจารย์
                    <input type="radio" name="status" value="student" <?php if ($status == 'student') echo 'checked'; ?> <?php echo $disabled;?> > นักเรียน
                    <input type="radio" name="status" value="ateacher" <?php if ($status == 'other') echo 'checked'; ?> <?php echo $disabled;?> > ธุรการ
                    <input type="radio" name="status" value="boss" <?php if ($status == 'other') echo 'checked'; ?> <?php echo $disabled;?> > ผู้อำนวยการ
                    <input type="radio" name="status" value="admin" <?php if ($status == 'other') echo 'checked'; ?> <?php echo $disabled;?> > ผู้ดูแลระบบ
                </div>

                <div class="form-group">
                    <label for="username">ชื่อผู้ใช้งาน <strong class="text-danger">**</strong></label>
                    <input class="form-control" name="username" type="text" aria-describedby="nameHelp"
                           placeholder="ชื่อผู้ใช้งาน" value="<?php echo $username; ?>" required>
                </div>

                <div class="form-group" <?php if (!$passwordCheck) echo 'hidden'; ?> >
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">รหัสผ่าน <strong class="text-danger">**</strong></label>
                            <input class="form-control password" name="password" type="password"
                                   placeholder="รหัสผ่าน" <?php if ($passwordCheck) echo 'required'; ?> >
                        </div>
                        <div class="col-md-6">
                            <label for="exampleConfirmPassword">ยืนยันรหัสผ่าน <strong class="text-danger">**</strong></label>
                            <input class="form-control confirmPassword" name="confirmPassword" type="password"
                                   placeholder="ยืนยันรหัสผ่าน" <?php if ($passwordCheck) echo 'required'; ?> >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="exampleInputName">ชื่อ <strong class="text-danger">**</strong></label>
                            <input class="form-control" name="name" type="text" aria-describedby="nameHelp"
                                   placeholder="ชื่อ" value="<?php echo $name; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputLastName">นามสกุล <strong class="text-danger">**</strong></label>
                            <input class="form-control" name="surname" type="text" aria-describedby="nameHelp"
                                   placeholder="นามสกุล" value="<?php echo $surname; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputIdCard">รหัสบัตรประจำตัวประชาชน <strong class="text-danger">**</strong></label>
                    <input class="form-control" name="id_card" type="text" placeholder="รหัสบัตรประจำตัวประชาชน"
                           value="<?php echo $id_card; ?>" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputBirthday">วันเกิด <strong class="text-danger">**</strong></label>
                    <input id="exampleinputbirthday" class="form-control datepicker" name="birthday"
                           type="text" value="<?php echo formatDate($birthday); ?>" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputPhone">เบอร์โทร</label>
                    <input class="form-control" name="phone" type="text" placeholder="เบอร์โทร"
                           value="<?php echo $phone; ?>">
                </div>

                <div class="form-group">
                    <label >ครูประจำชั้น</label>
                    <input class="form-control" name="class_teacher" type="text" placeholder="ชื่อ-สกุล"
                           value="" <?php echo $disabled;?>>
                </div>

                <div class="form-group">
                    <label for="exampleInputAddress">ที่อยู่</label>
                    <textarea class="form-control" name="address" type="text"
                              placeholder="ที่อยู่"><?php echo $address; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputGender">เพศ</label><br>
                    <input type="radio" name="gender" value="m" <?php if ($gender == 'm' || $gender=='') echo 'checked'; ?>  > ชาย
                    <input type="radio" name="gender" value="f" <?php if ($gender == 'f') echo 'checked'; ?> > หญิง
                </div>

                <hr>
                <h5> ข้อมูลบิดา </h5>
                <div class="form-group">
                    <label for="nameFatherId">ชื่อ-สกุล บิดา</label>
                    <input id="nameFatherId" class="form-control" name="name_father" type="text" placeholder="ชื่อ-สกุล"
                           value="<?php echo $name_father; ?>" <?php echo $disabled;?>>
                </div>
                <div class="form-group">
                    <label for="dataFatherId">ข้อมูลบิดา</label>
                    <textarea id="dataFatherId" class="form-control" name="data_father" type="text"
                              placeholder="รายละเอียดทั่วไป เช่น อาชีพ,ที่อยู่ ฯลฯ" <?php echo $disabled;?>><?php echo $data_father; ?></textarea>
                </div>

                <hr>
                <h5> ข้อมูลมารดา </h5>
                <div class="form-group">
                    <label for="nameMotherId">ชื่อ-สกุล มารดา</label>
                    <input id="nameMotherId" class="form-control" name="name_mother" type="text" placeholder="ชื่อ-สกุล"
                           value="<?php echo $name_mother; ?>" <?php echo $disabled;?>>
                </div>
                <div class="form-group">
                    <label for="dataMotherId">ข้อมูลมารดา</label>
                    <textarea id="dataMotherId" class="form-control" name="data_mother" type="text"
                              placeholder="รายละเอียดทั่วไป เช่น อาชีพ,ที่อยู่ ฯลฯ" <?php echo $disabled;?>><?php echo $data_mother; ?></textarea>
                </div>

                <hr>
                <h5> ข้อมูลทั่วไป </h5>
                <div class="date_admission form-group">
                    <label for="dateAdmissionId">วันที่เข้าเรียน</label>
                    <input id="dateAdmissionId" class="datepicker form-control" name="date_admission" type="text"
                           value="<?php echo formatDate($date_admission); ?>" <?php echo $disabled;?>>
                </div>
                <div class="report_grade form-group">
                    <label for="reportGradeId">รายงานผลการเรียนเดิม</label>
                    <textarea id="reportGradeId" class="form-control" name="report_grade" type="text"
                              placeholder="รายงานผลการเรียนเดิม" <?php echo $disabled;?> ><?php echo $report_grade; ?></textarea>
                </div>
                <div class="date_issue form-group">
                    <label for="dateIssueId">วันที่จำหน่าย</label>
                    <input id="dateIssueId" class="datepicker form-control" name="date_issue" type="text"
                           value="<?php echo formatDate($date_issue); ?>" <?php echo $disabled;?> >
                </div>
                <div class="note_issue form-group">
                    <label for="note_issueId">เหตุที่จำหน่าย</label>
                    <textarea id="note_issueId" class="form-control" name="note_issue" type="text"
                              placeholder="เหตุที่จำหน่าย" <?php echo $disabled;?> ><?php echo $note_issue; ?></textarea>
                </div>
                <div class="detail_report form-group">
                    <label for="detail_reportId">ความรู้และความประพฤติ</label>
                    <textarea id="detail_reportId" class="form-control" name="detail_report" type="text"
                              placeholder="ความรู้และความประพฤติ" <?php echo $disabled;?> ><?php echo $detail_report; ?></textarea>
                </div>
                <div class="address_birth form-group">
                    <label for="address_birthId">สถานที่เกิด</label>
                    <textarea id="address_birthId" class="form-control" name="address_birth" type="text"
                              placeholder="สถานที่เกิด" <?php echo $disabled;?> ><?php echo $address_birth; ?></textarea>
                </div>
                <div class="old_school form-group">
                    <label for="old_schoolId">สถานศึกษาเดิม</label>
                    <textarea id="old_schoolId" class="form-control" name="old_school" type="text"
                              placeholder="สถานศึกษาเดิม" <?php echo $disabled;?> ><?php echo $old_school; ?></textarea>
                </div>
                <div class="note_change_school form-group">
                    <label for="note_change_schoolId">เหตุที่ย้าย</label>
                    <textarea id="note_change_schoolId" class="form-control" name="note_change_school" type="text"
                              placeholder="เหตุที่ย้าย" <?php echo $disabled;?> ><?php echo $note_change_school; ?></textarea>
                </div>
                <div class="home_birth form-group">
                    <label for="home_birthId">บ้านเกิด</label>
                    <textarea id="home_birthId" class="form-control" name="home_birth" type="text"
                              placeholder="บ้านเกิด" <?php echo $disabled;?> ><?php echo $home_birth; ?></textarea>
                </div>

                <div class="home_birth form-group">
                    <label for="old_subjectId">มีคุณวิชามาเพียงไร</label>
                    <textarea id="old_subjectId" class="form-control" name="old_subject" type="text"
                              placeholder="คุณวิชา" <?php echo $disabled;?> ><?php echo $old_subject; ?></textarea>
                </div>

                <div class="home_birth form-group">
                    <label for="old_gradeId">เดิมเรียนมาจากไหน</label>
                    <textarea id="old_gradeId" class="form-control" name="old_grade" type="text"
                              placeholder="เดิมเรียนมาจากไหน" <?php echo $disabled;?> ><?php echo $old_grade; ?></textarea>
                </div>


                <input id="path_upload" name="img_path" value="<?php echo $img_path; ?>" hidden>

                <?php if ($passwordCheck): ?>
                    <input name="fn" value="insert" hidden>
                    <button class="btn btn-primary btn-block mt-5" type="submit">Register</button>
                <?php else: ?>
                    <input name="fn" value="update" hidden>
                    <input name="id" value="<?php echo $id; ?>" hidden>
                    <button class="btn btn-primary btn-block mt-5" type="submit">Edit</button>
                <?php endif; ?>
            </form>

        </div>
    </div>
</div>

</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
    <script>

        $(".password").change(function () {
            $(".confirmPassword").val('');
        });
        $(".confirmPassword").change(function () {
            var password = $(".password").val();
            var confirm = $(".confirmPassword").val();
            if (confirm != password) {
                alert("Confirm password Error!!");
                $(".password").val('');
                $(".confirmPassword").val('');
            }

        });

        function changePassword() {
            $("#changePassword").attr('hidden',false);
        }
        function changePasswordClose() {
            $("#changePassword").attr('hidden',true);
        }


        var ajax_upload;
        function uploadFile(input) {
            if (input.files && input.files[0]) {
                ajax_upload = new XMLHttpRequest();
                var file_name = input.files[0].name;
                //console.log(file_name);

                var cut_type_file = file_name.split('.');
                var file_type = cut_type_file[cut_type_file.length - 1];
                file_type = file_type.toLowerCase();
                var file_type_set_accept = ["png", "jpg"];
                var set_type_upload = "profile";
                //console.log(file_type);

                //check type file upload
                if (file_type_set_accept.indexOf(file_type) >= 0) {

                    var show_progressBar_upload = "show_progressBar_upload";
                    var progressBar = "progressBar_upload";

                    $('#' + show_progressBar_upload).removeAttr('hidden');

                    var form_data = new FormData();
                    form_data.append("fileToUpload", input.files[0]);
                    ajax_upload.upload.addEventListener("progress", progressHandler, false);
                    ajax_upload.addEventListener("load", completeHandler, false);
                    ajax_upload.addEventListener("error", errorHandler, false);
                    ajax_upload.addEventListener("abort", abortHandler, false);
                    ajax_upload.open("POST", "/school/upload/upload_file.php?type=" + set_type_upload);
                    ajax_upload.send(form_data);

                    function progressHandler(event) {
                        var percent = (event.loaded / event.total) * 100;
                        $("#" + progressBar).css('width', Math.round(percent) + "%");
                        $("#" + progressBar).html(Math.round(percent) + "%");
                    }

                    function completeHandler(event) {
                        var data_return = JSON.parse(event.target.responseText);
                        if (data_return['status'] == 'ok') {
                            var src = '/school/upload/file_upload/' + data_return['new_name'];
                            var res_filename = data_return['file_name'];
                            $('#' + show_progressBar_upload).attr("hidden", true);
                            $("#" + progressBar).css('width', "0%");
                            $("#" + progressBar).html("0%");

                            $('#src_image').attr('src', src);
                            $('#path_upload').attr('value', src);
//                            $('#name_upload').attr('value',res_filename);


                        } else {
                            ajax_upload.abort();
                            alert("Error:" + data_return['message']);
                            $("#" + progressBar).css('width', "0%");
                            $("#" + progressBar).html("0%");
                        }
                    }

                    function errorHandler(event) {
                        ajax_upload.abort();
                        alert("Upload Failed");
                        $('#' + show_progressBar_upload).attr("hidden", true);
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");

                    }

                    function abortHandler(event) {
                        ajax_upload.abort();
                        alert("Upload Aborted");
                        $('#' + show_progressBar_upload).attr("hidden", true);
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");
                    }

                } else {
                    alert("File type cannot upload!!!");
                }
            } else {
                alert("Not found file input!!!");
            }
        }
        function cancelUploadFile() {
            ajax_upload.abort();
            $('#show_progressBar_upload').attr("hidden", true);
            $("#file_upload").val("");

        }

    </script>

</footer>
