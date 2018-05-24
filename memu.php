<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <h2 class="navbar-brand">เมนูหลัก</h2>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
	<div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-home"></i>
            <span class="nav-link-text">หน้าหลัก</span>
          </a>
        </li>
		
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti1" data-parent="#exampleAccordion">
            <i class="fa fa-address-card"></i>
            <span class="nav-link-text">ข้อมูลทั่วไป</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti1">
            <li>
              <a href="aboutSchool.php">เกี่ยวกับโรงเรียน</a>
            </li>
            <li>
              <a href="aboutTeacher.php">ข้อมูลครู</a>
            </li>
            <li>
              <a href="aboutItem.php">ข้อมูลครุภัณฑ์</a>
            </li>
            <li>
              <a href="aboutStudent.php">ข้อมูลนักเรียน</a>
            </li>

          </ul>
        </li>
		
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2" data-parent="#exampleAccordion">
            <i class="fa fa-address-card"></i>
            <span class="nav-link-text">ทะเบียนเงินออม</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti2">
            <li>
              <a href="#">พ.ศ.2550</a>
            </li>
            <li>
              <a href="#">พ.ศ.2551</a>
            </li>
            <li>
              <a href="#">พ.ศ.2552</a>
            </li>

          </ul>
        </li>
		
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti3" data-parent="#exampleAccordion">
            <i class="fa fa-address-card"></i>
            <span class="nav-link-text">ทะเบียนนักเรียน</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti3">
            <li>
              <a href="#">พ.ศ.2550</a>
            </li>
            <li>
              <a href="#">พ.ศ.2551</a>
            </li>
            <li>
              <a href="#">พ.ศ.2552</a>
            </li>

          </ul>
        </li>
		
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-user-o"></i>
            <span class="nav-link-text">จัดการสมาชิก</span>
          </a>
          <ul class="sidenav-second-level collapse <?php if($menuAction=='user')echo 'show'; ?>" id="collapseExamplePages">
            <li>
              <a href="login.php">เข้าสู่ระบบ</a>
            </li>
            <li>
                <a href="/userManage.php">ข้อมูลสมาชิก</a>
            </li>
            <li>
              <a href="/register.php">เพิ่มสมาชิก</a>
            </li>
          </ul>
        </li>
				
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="document.php">
            <i class="fa fa-server"></i>
            <span class="nav-link-text">ดาวโหลดเอกสาร</span>
          </a>
        </li>
		
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="link.php">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">เว็บไซต์ที่เกี่ยวข้อง </span>
          </a>
        </li>

      </ul>
	  
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
	  
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>ออกจากระบบ</a>
        </li>
      </ul>
    </div>
    </nav>

        <!-- Logout Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>