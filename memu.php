
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <h2 class="navbar-brand">เมนูหลัก</h2>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse" id="navbarResponsive">

        <!-- left menu -->
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion"  <?php echo $SESSION_user_id==0?'hidden':'';?>>
            <li class="nav-item" >
                <div class="text-center">
                    <img src="<?php echo $SESSION_user_img_path;?>" class="img-thumbnail" alt="user image" style="width: 120px; height: 120px;">
                    <p><a href="/school/register.php?fn=edit&id=<?php echo $SESSION_user_id;?>" style="color: white"><strong><?php echo $SESSION_user_username;?></strong></a></p>
                </div>
            </li>

            <!-- ข้อมูลทั่วไป -->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti1"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-share"></i>
                    <span class="nav-link-text">ข้อมูลทั่วไป</span>
                </a>
                <ul class="sidenav-second-level collapse <?php if ($menuAction == 'about') echo 'show'; ?>" id="collapseMulti1">
                    <li class="<?PHP echo ($menuAbout == 'school') ? 'active' : ''; ?>">
                        <a href="aboutSchoolEdit.php">เกี่ยวกับโรงเรียน</a>
                    </li>
                    <li class="<?PHP echo ($menuAbout == 'teacher') ? 'active' : ''; ?>">
                        <a href="aboutTeacherEdit.php">ข้อมูลครู</a>
                    </li>
                    <li class="<?PHP echo ($menuAbout == 'item') ? 'active' : ''; ?>">
                        <a href="aboutItemEdit.php">ข้อมูลครุภัณฑ์</a>
                    </li>
                </ul>
            </li>

            <!-- จัดการสมาชิก -->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-user-o"></i>
                    <span class="nav-link-text">จัดการสมาชิก</span>
                </a>
                <ul class="sidenav-second-level collapse <?php if ($menuAction == 'user') echo 'show'; ?>"
                    id="collapseExamplePages">
                    <li class="<?PHP echo ($menuSub == 'list') ? 'active' : ''; ?>">
                        <a href="userManage.php">ข้อมูลสมาชิก</a>
                    </li>
                    <li class="<?PHP echo ($menuSub == 'register') ? 'active' : ''; ?>">
                        <a href="register.php">เพิ่มสมาชิก</a>
                    </li>
<!--                    <li>-->
<!--                        <a href="teacher_managestudent.php">จัดการผู้เรียน</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="teacher_checkname.php">เช็คชื่อเข้าเรียน</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="teacher_inputscore.php">กรอกคะแนน</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="teacher_name.php">ข้อมูลการเข้าเรียน</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="teacher_score.php">ผลการเรียน</a>-->
<!--                    </li>-->
                </ul>
            </li>

            <!-- ทะเบียนนักเรียน -->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-book"></i>
                    <span class="nav-link-text">ทะเบียนนักเรียน</span>
                </a>
                <ul class="sidenav-second-level collapse <?php if ($menuAction == 'class') echo 'show'; ?>"
                    id="collapseMulti2">
                    <li class="<?PHP echo ($menuClass == '10') ? 'active' : ''; ?>">
                        <a href="teacher_class.php?class=10">อนุบาล 1</a>
                    </li>
                    <li class="<?PHP echo ($menuClass == '20') ? 'active' : ''; ?>">
                        <a href="teacher_class.php?class=20">อนุบาล 2</a>
                    </li>
                    <li class="<?PHP echo ($menuClass == '1') ? 'active' : ''; ?>">
                        <a href="teacher_class.php?class=1">ประถมศึกษาปีที่ 1</a>
                    </li>
                    <li class="<?PHP echo ($menuClass == '2') ? 'active' : ''; ?>">
                        <a href="teacher_class.php?class=2">ประถมศึกษาปีที่ 2</a>
                    </li>
                    <li class="<?PHP echo ($menuClass == '3') ? 'active' : ''; ?>">
                        <a href="teacher_class.php?class=3">ประถมศึกษาปีที่ 3</a>
                    </li>
                    <li class="<?PHP echo ($menuClass == '4') ? 'active' : ''; ?>">
                        <a href="teacher_class.php?class=4">ประถมศึกษาปีที่ 4</a>
                    </li>
                    <li class="<?PHP echo ($menuClass == '5') ? 'active' : ''; ?>">
                        <a href="teacher_class.php?class=5">ประถมศึกษาปีที่ 5</a>
                    </li>
                    <li class="<?PHP echo ($menuClass == '6') ? 'active' : ''; ?>">
                        <a href="teacher_class.php?class=6">ประถมศึกษาปีที่ 6</a>
                    </li>
                </ul>
            </li>

            <!-- จัดการรายวิชา -->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti4"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-server"></i>
                    <span class="nav-link-text">จัดการรายวิชา</span>
                </a>
                <ul class="sidenav-second-level collapse <?php if ($menuAction == 'course') echo 'show'; ?>" id="collapseMulti4">
                    <li class="<?PHP echo ($menuCourse == 'create') ? 'active' : ''; ?>">
                        <a href="teacher_coursecreate.php">สร้างรายวิชา</a>
                    </li>
                    <li class="<?PHP echo ($menuCourse == '1') ? 'active' : ''; ?>">
                        <a href="teacher_course.php?class=1">ประถมศึกษาปีที่ 1</a>
                    </li>
                    <li class="<?PHP echo ($menuCourse == '2') ? 'active' : ''; ?>">
                        <a href="teacher_course.php?class=2">ประถมศึกษาปีที่ 2</a>
                    </li>
                    <li class="<?PHP echo ($menuCourse == '3') ? 'active' : ''; ?>">
                        <a href="teacher_course.php?class=3">ประถมศึกษาปีที่ 3</a>
                    </li>
                    <li class="<?PHP echo ($menuCourse == '4') ? 'active' : ''; ?>">
                        <a href="teacher_course.php?class=4">ประถมศึกษาปีที่ 4</a>
                    </li>
                    <li class="<?PHP echo ($menuCourse == '5') ? 'active' : ''; ?>">
                        <a href="teacher_course.php?class=5">ประถมศึกษาปีที่ 5</a>
                    </li>
                    <li class="<?PHP echo ($menuCourse == '6') ? 'active' : ''; ?>">
                        <a href="teacher_course.php?class=6">ประถมศึกษาปีที่ 6</a>
                    </li>

                </ul>
            </li>

            <!-- เงินออม -->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti3"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-money"></i>
                    <span class="nav-link-text">เงินออม</span>
                </a>
                <ul class="sidenav-second-level collapse <?php if ($menuAction == 'saving') echo 'show'; ?>" id="collapseMulti3">
                    <li class="<?PHP echo ($menuSave == '0') ? 'active' : ''; ?>">
                        <a href="teacher_savesearch.php">ค้นหา</a>
                    </li>
                    <li class="<?PHP echo ($menuSave == '10') ? 'active' : ''; ?>">
                        <a href="teacher_savelist.php?class=10">อนุบาล 1</a>
                    </li>
                    <li class="<?PHP echo ($menuSave == '20') ? 'active' : ''; ?>">
                        <a href="teacher_savelist.php?class=20">อนุบาล 2</a>
                    </li>
                    <li class="<?PHP echo ($menuSave == '1') ? 'active' : ''; ?>">
                        <a href="teacher_savelist.php?class=1">ประถมศึกษาปีที่ 1</a>
                    </li>
                    <li class="<?PHP echo ($menuSave == '2') ? 'active' : ''; ?>">
                        <a href="teacher_savelist.php?class=2">ประถมศึกษาปีที่ 2</a>
                    </li>
                    <li class="<?PHP echo ($menuSave == '3') ? 'active' : ''; ?>">
                        <a href="teacher_savelist.php?class=3">ประถมศึกษาปีที่ 3</a>
                    </li>
                    <li class="<?PHP echo ($menuSave == '4') ? 'active' : ''; ?>">
                        <a href="teacher_savelist.php?class=4">ประถมศึกษาปีที่ 4</a>
                    </li>
                    <li class="<?PHP echo ($menuSave == '5') ? 'active' : ''; ?>">
                        <a href="teacher_savelist.php?class=5">ประถมศึกษาปีที่ 5</a>
                    </li>
                    <li class="<?PHP echo ($menuSave == '6') ? 'active' : ''; ?>">
                        <a href="teacher_savelist.php?class=6">ประถมศึกษาปีที่ 6</a>
                    </li>
                </ul>
            </li>

            <!-- ผลคะแนน -->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Grade">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMultiGrade"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-calculator"></i>
                    <span class="nav-link-text">ผลคะแนน</span>
                </a>
                <ul class="sidenav-second-level collapse <?php if ($menuAction == 'grade') echo 'show'; ?>" id="collapseMultiGrade">
                    <li class="<?PHP echo ($menuGrade == '0') ? 'active' : ''; ?>">
                        <a href="#">ค้นหา</a>
                    </li>
                    <li class="<?PHP echo ($menuGrade == '10') ? 'active' : ''; ?>">
                        <a href="teacher_score.php?class=10">อนุบาล 1</a>
                    </li>
                    <li class="<?PHP echo ($menuGrade == '20') ? 'active' : ''; ?>">
                        <a href="teacher_score.php?class=20">อนุบาล 2</a>
                    </li>
                    <li class="<?PHP echo ($menuGrade == '1') ? 'active' : ''; ?>">
                        <a href="teacher_score.php?class=1">ประถมศึกษาปีที่ 1</a>
                    </li>
                    <li class="<?PHP echo ($menuGrade == '2') ? 'active' : ''; ?>">
                        <a href="teacher_score.php?class=2">ประถมศึกษาปีที่ 2</a>
                    </li>
                    <li class="<?PHP echo ($menuGrade == '3') ? 'active' : ''; ?>">
                        <a href="teacher_score.php?class=3">ประถมศึกษาปีที่ 3</a>
                    </li>
                    <li class="<?PHP echo ($menuGrade == '4') ? 'active' : ''; ?>">
                        <a href="teacher_score.php?class=4">ประถมศึกษาปีที่ 4</a>
                    </li>
                    <li class="<?PHP echo ($menuGrade == '5') ? 'active' : ''; ?>">
                        <a href="teacher_score.php?class=5">ประถมศึกษาปีที่ 5</a>
                    </li>
                    <li class="<?PHP echo ($menuGrade == '6') ? 'active' : ''; ?>">
                        <a href="teacher_score.php?class=6">ประถมศึกษาปีที่ 6</a>
                    </li>
                </ul>
            </li>

            <!-- เข้าเรียน -->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Grade">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMultiCheck"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-check-square-o"></i>
                    <span class="nav-link-text">เช็คชื่อ/เข้าเรียน</span>
                </a>
                <ul class="sidenav-second-level collapse <?php if ($menuAction == 'check') echo 'show'; ?>" id="collapseMultiCheck">
                    <li class="<?PHP echo ($menuCheck == '10') ? 'active' : ''; ?>">
                        <a href="teacher_checkname.php?class=10">อนุบาล 1</a>
                    </li>
                    <li class="<?PHP echo ($menuCheck == '20') ? 'active' : ''; ?>">
                        <a href="teacher_checkname.php?class=20">อนุบาล 2</a>
                    </li>
                    <li class="<?PHP echo ($menuCheck == '1') ? 'active' : ''; ?>">
                        <a href="teacher_checkname.php?class=1">ประถมศึกษาปีที่ 1</a>
                    </li>
                    <li class="<?PHP echo ($menuCheck == '2') ? 'active' : ''; ?>">
                        <a href="teacher_checkname.php?class=2">ประถมศึกษาปีที่ 2</a>
                    </li>
                    <li class="<?PHP echo ($menuCheck == '3') ? 'active' : ''; ?>">
                        <a href="teacher_checkname.php?class=3">ประถมศึกษาปีที่ 3</a>
                    </li>
                    <li class="<?PHP echo ($menuCheck == '4') ? 'active' : ''; ?>">
                        <a href="teacher_checkname.php?class=4">ประถมศึกษาปีที่ 4</a>
                    </li>
                    <li class="<?PHP echo ($menuCheck == '5') ? 'active' : ''; ?>">
                        <a href="teacher_checkname.php?class=5">ประถมศึกษาปีที่ 5</a>
                    </li>
                    <li class="<?PHP echo ($menuCheck == '6') ? 'active' : ''; ?>">
                        <a href="teacher_checkname.php?class=6">ประถมศึกษาปีที่ 6</a>
                    </li>
                </ul>
            </li>

            <!-- เพิ่มข่าวประกาศ -->
            <li class="nav-item <?PHP echo ($menuAction == 'news') ? 'active' : ''; ?>" data-toggle="tooltip"
                data-placement="right" title="Link">
                <a class="nav-link" href="news.php">
                    <i class="fa fa-list-alt"></i>
                    <span class="nav-link-text"> ข่าว/ประกาศ </span>
                </a>
            </li>



<!--            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">-->
<!--                <a class="nav-link" href="document.php">-->
<!--                    <i class="fa fa-server"></i>-->
<!--                    <span class="nav-link-text">ดาวโหลดเอกสาร</span>-->
<!--                </a>-->
<!--            </li>-->
<!---->
<!--            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">-->
<!--                <a class="nav-link" href="link.php">-->
<!--                    <i class="fa fa-fw fa-link"></i>-->
<!--                    <span class="nav-link-text">เว็บไซต์ที่เกี่ยวข้อง </span>-->
<!--                </a>-->
<!--            </li>-->



        </ul>

        <!-- tab bank -->
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>

        <!-- top menu -->
        <ul class="navbar-nav">
            <li class="nav-item  <?php if ($menuAction == 'home') echo 'active'; ?>">
                <a class="nav-link" href="index.php">
                    <i class="fa fa-fw fa-home"></i> หน้าหลัก
                </a>
            </li>
            <li class="nav-item <?php if ($menuAction == 'school') echo 'active'; ?>">
                <a class="nav-link" href="aboutSchool.php">
                    <i class="fa fa-fw fa-bank"></i> เกี่ยวกับโรงเรียน
                </a>
            </li>
            <li class="nav-item <?php if ($menuAction == 'teacher') echo 'active'; ?>">
                <a class="nav-link" href="aboutTeacher.php">
                    <i class="fa fa-fw fa-graduation-cap"></i> ครู
                </a>
            </li>
            <li class="nav-item <?php if ($menuAction == 'item') echo 'active'; ?>">
                <a class="nav-link" href="aboutItem.php">
                    <i class="fa fa-fw fa-building-o"></i> ครุภัณฑ์
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-fw fa-group"></i> นักเรียน
                </a>
            </li>
        </ul>
        <!-- log in / out menu -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item" <?php echo $SESSION_user_id == 0 ?'hidden':'';?>>
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>ออกจากระบบ</a>
            </li>
            <li class="nav-item" <?php echo $SESSION_user_id != 0 ?'hidden':'';?>>
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal2">
                    <i class="fa fa-key"></i>เข้าสู่ระบบ</a>
            </li>
        </ul>


    </div>
</nav>

<!-- Logout Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ต้องการออกจากระบบ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">ถ้าต้องการออกจากระบบให้กดที่ Logout</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="controller/logoutController.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">คุณมีรหัสแล้วหรือยัง?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">ถ้ายังไม่มีกรุณาสมัครสมาชิกก่อน</div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="login.php">เข้าสู่ระบบ</a>
                <a class="btn btn-primary" href="register.php">สมัครสมาชิก</a>
            </div>
        </div>
    </div>
</div>